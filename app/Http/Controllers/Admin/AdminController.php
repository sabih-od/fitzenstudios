<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AdminCreateSession;
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
    public function dashboard(){

        $requests           = BookDemoSession::where('status','pending')->orderBy('id','DESC')->get();
        $sessions           = CustomerToTrainer::with('customer', 'trainer')->where('status','!=','canceled')->orderBy('id', 'DESC')->get();
        $current_date       = date('Y-m-d');
        $upcoming_sessions  = CustomerToTrainer::with('customer', 'trainer')->where('trainer_date', $current_date)->orderBy('id', 'DESC')->get();
//        dd($upcoming_sessions);

        $demo_data = [];
        $i         = 0;
        $trainers  = Trainer::all();
        $customers = Customer::where('is_lead', 0)->get();
        foreach ($sessions as $demo) {
            $currentDateTime = $demo->trainer_time;
            $newDateTime     = date('h:i A', strtotime($currentDateTime));

            $demo_data[$i]['id']          = $demo->id;
            $demo_data[$i]['title']       = $newDateTime.' '.$demo->session_type;
            $demo_data[$i]['start']       = $demo->trainer_date;
            $demo_data[$i]['description'] = $demo;
            $i++;
        }

        return view('admin.dashboard', compact('upcoming_sessions', 'requests', 'sessions', 'demo_data', 'trainers', 'customers'));
    }

    public function ChangePassword(Request $request){

        if ($request->method() == 'POST'){
            if($request->input('password') != $request->input('password_confirmation')){
                return redirect()->back()->
                with(['error' => 'Password and confirm password does not match']);
            }

            $user = User::findOrFail(Auth::id());
            if (Hash::check($request->old_password, $user->password)) {
                $user->fill([
                    'password' => Hash::make($request->password)
                ])->save();
               return redirect()->back()->with(['success' => 'Password changed']);
           }
           else {
            return redirect()->back()->with(['error' => 'Old password does not match']);
            }

        }
        return view('admin.change_password');
    }

    public function DemoSession($id) {
        $session  = BookDemoSession::find($id);
        $trainers = Trainer::all();
        return view('admin.demo_session', compact('session', 'trainers'));
    }

    public function login(){
        return view('admin.login');
    }

    public function PermanentCustomer($lead_id) {

        $update_lead               = Lead::find($lead_id);
        $update_lead->is_customer  = 1;
        $update_lead->save();

        $user_id                   = $update_lead->user_id;
        $get_cust_id               = Customer::where('user_id', $user_id)->first();

        $confirm_customer          = Customer::find($get_cust_id->id);
        $confirm_customer->is_lead = 0;
        $confirm_customer->type    = "permanent";
        $confirm_customer->save();

        $username = $update_lead->first_name .' '.$update_lead->last_name;
        return redirect()->back()->with('success', 'Your Lead "'.$username.'" now confirms as an permanent customer...!!');

    }

    public function CreateSession(Request $request) {

        $customers = Customer::where('is_lead', 0)->get();
        $customers = Customer::get();
        $trainers  = Trainer::all();
        $zones     = TimeZone::all();
//        $AdminCreateSession=new AdminCreateSession();
//        $AdminCreateSession->trainer_id = $request->trainer_id;
//        $AdminCreateSession->customer_id = $request->customer_id;
//        $AdminCreateSession->session_type = $request->session_type;
//        $AdminCreateSession->time_zone = $request->time_zone;
//        $AdminCreateSession->notes = $request->notes;
//        $AdminCreateSession->trainer_date = $request->trainer_date;
//        $AdminCreateSession->trainer_time = $request->trainer_time;
//        $AdminCreateSession->save();

        return view('admin.create_session', compact('customers', 'trainers', 'zones'));
    }
}
