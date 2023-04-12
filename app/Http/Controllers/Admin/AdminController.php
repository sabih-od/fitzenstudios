<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\BookDemoSession;
use App\Models\Trainer;
use App\Models\Customer;
use App\Models\Lead;
use App\Models\TimeZone;
use App\Models\CustomerToTrainer;

class AdminController extends Controller
{
    public function dashboard()
    {
        $requests = BookDemoSession::where('status', 'pending')->orderBy('id', 'DESC')->get();
        $sessions = CustomerToTrainer::with('customer', 'trainer')
            ->where('status', '!=', 'canceled')
            ->orderBy('trainer_date')
            ->get()
            ->groupBy(function ($item) {
                return $item->trainer_date . "_" . $item->trainer_time;
            })
            ->map(function ($item) {
                return $item[0];
            });
        $start_date = date('Y-m-d');
        $now = Carbon::now();
        $currentMonth_end = $now->endOfMOnth()->format('Y-m-d');
        $upcoming_sessions = CustomerToTrainer::with('customer', 'trainer')
            ->whereBetween('trainer_date', [$start_date, $currentMonth_end])
            ->where('status', '!=', 'canceled')
            ->orderBy('trainer_date', 'ASC')
            ->get()
            ->groupBy(function ($item) {
                return $item->trainer_date . "_" . $item->trainer_time;
            })
            ->map(function ($item) {
                return $item[0];
            })
            ->take(8);

        $demo_data = [];
        $i = 0;
        $trainers = Trainer::all();
        $customers = Customer::where('is_lead', 0)->get();
        foreach ($sessions as $demo) {
            $currentDateTime = $demo->trainer_time;
            $newDateTime = date('h:i A', strtotime($currentDateTime));

            $demo_data[$i]['id'] = $demo->id;
            $demo_data[$i]['title'] = $newDateTime . ' ' . $demo->session_type;
            $demo_data[$i]['start'] = $demo->trainer_date;
            $demo_data[$i]['description'] = $demo;
            $i++;
        }
        return view('admin.dashboard', compact('upcoming_sessions', 'requests', 'sessions', 'demo_data', 'trainers', 'customers'));
    }

    public function ChangePassword(Request $request)
    {
        try {
            if ($request->method() == 'POST') {
                if ($request->input('password') != $request->input('password_confirmation')) {
                    return redirect()->back()->with(['error' => 'Password and confirm password does not match']);
                }

                $user = User::findOrFail(Auth::id());
                if (Hash::check($request->old_password, $user->password)) {
                    $user->fill([
                        'password' => Hash::make($request->password)
                    ])->save();
                    return redirect()->back()->with(['success' => 'Password changed']);
                } else {
                    return redirect()->back()->with(['error' => 'Old password does not match']);
                }
            }
            return view('admin.change_password');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function DemoSession($id)
    {
        $session = BookDemoSession::find($id);
        $session = $session->load('timeZone');
        return view('admin.demo_session')
            ->with('session', $session)
            ->with('trainers', Trainer::all());
    }

    public function login()
    {
        return view('admin.login');
    }

    public function PermanentCustomer($lead_id)
    {
        try {
            $update_lead = Lead::findOrFail($lead_id);
            $update_lead->is_customer = 1;
            $update_lead->save();

            $user_id = $update_lead->user_id;
            $get_cust_id = Customer::where('user_id', $user_id)->first();

            $confirm_customer = Customer::findOrFail($get_cust_id->id);
            $confirm_customer->is_lead = 0;
            $confirm_customer->type = "permanent";
            $confirm_customer->save();

            $username = $update_lead->first_name . ' ' . $update_lead->last_name;
            return redirect()->back()->with('success', 'Your Lead "' . $username . '" now confirms as an permanent customer...!!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'This customer is not exists anymore.');
        }
    }

    public function CreateSession(Request $request)
    {
        $customers = Customer::get();
        $trainers = Trainer::all();

        // Check if any customer or trainer has been deleted
        if($customers->isEmpty() || $trainers->isEmpty()) {
            $message = null;
            $route = null;
            if($customers->isEmpty()) {
                $message = 'No customer found. Please add customer.';
                $route = 'customer.index';
            }

            if($trainers->isEmpty()) {
                $message = 'No trainer found. Please add trainer.';
                $route = 'trainer.index';
            }
            return redirect()->route($route)->with('error', $message);
        }

        return view('admin.create_session')
            ->with('customers', Customer::get())
            ->with('trainers', Trainer::all())
            ->with('zones', TimeZone::all());
    }
}
