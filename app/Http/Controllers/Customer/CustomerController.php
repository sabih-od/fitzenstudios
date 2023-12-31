<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\TimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Models\BookDemoSession;
use App\Models\Customer;
use App\Models\Trainer;
use App\Models\CustomerToTrainer;
use App\Models\Contract;
use App\Models\Payment;
use App\Models\Review;
use Carbon\Carbon;

use App\Models\Performance;

class CustomerController extends Controller
{
    public function dashboard()
    {
        $user_id = Auth::user()->id;
        $now = Carbon::now();
        $currentMonth_start = $now->startOfMOnth()->format('Y-m-d');
//        $currentMonth_end = $now->endOfMOnth()->format('Y-m-d');
//        $demos = BookDemoSession::where('customer_id', Auth::user()->customer->id)
//            ->with('Customer', 'Customer.trainer')->orderBy('id', 'DESC')->get();
        $demo_data = [];
        $i = 0;
        $get_cust_id = Customer::where('user_id', $user_id)->first();
        $upcoming_sessions = CustomerToTrainer::with(['timeZone', 'customer', 'trainer', 'reviews', 'request_session' => function ($q) {
            $q->where('request_by', '!=', 'trainer');
        }])
            ->where('customer_id', $get_cust_id->id)
            ->whereDate('trainer_date', '>=', $currentMonth_start)
            ->whereNotIn('status', ['completed', 'canceled', 'cancelled'])
            ->orderBy('trainer_date','ASC')
            ->orderBy('trainer_time', 'ASC')
            ->get()
            ->map(function ($item) use ($now) {
                $item_zone = $item->timeZone->timezone_value ?? $now->getTimezone();
                $zone = $item->customer->timeZone->timezone_value ?? $item_zone;
                $dt = $item->trainer_date . " " . $item->trainer_time;
                if (Carbon::hasFormat($dt, "Y-m-d H:i:s")) {
                    $item->date_time_carbon = Carbon::createFromFormat(
                        "Y-m-d H:i:s",
                        $dt,
                        $item_zone
                    );
                    $item->converted_time = (clone $item->date_time_carbon)->setTimezone($zone);
                }elseif (Carbon::hasFormat($dt, "Y-m-d H:i")){
                    $item->date_time_carbon = Carbon::createFromFormat(
                        "Y-m-d H:i",
                        $dt,
                        $item_zone
                    );
                    $item->converted_time = (clone $item->date_time_carbon)->setTimezone($zone);
                }
                return $item;
            })
            ->groupBy(function ($item) {
                return $item->trainer_date . "_" . $item->trainer_time;
            })
            ->map(function ($item) {
                return $item[0];
            });
        foreach ($upcoming_sessions as $demo) {
            $demo_data[$i]['id'] = $demo->id;
            $demo_data[$i]['title'] = $demo->session_type;
            $demo_data[$i]['start'] = $demo->converted_time->format('Y-m-d');
            $demo_data[$i]['description'] = $demo;
            $demo_data[$i]['rendering'] = $demo->status;
            $i++;
        }
        return view('customer.dashboard', compact('demo_data', 'upcoming_sessions'));
    }


    public function customersitecalendardatafetch(Request $request)
    {
        try {
            $now = Carbon::now();
            $user_id = Auth::user()->id;
            $get_cust_id = Customer::where('user_id', $user_id)->first();
            $customer_zone = $get_cust_id->timeZone->timezone_value ?? $now->getTimezone();
            $now->setTimezone($customer_zone);
            $start_date = Carbon::createFromFormat('D M d Y', $request->start_date, $customer_zone);
            $end_date = Carbon::createFromFormat('D M d Y', $request->end_date, $customer_zone)->subDay();
            $subDates = $now->diffInDays($start_date, false);
            if ($subDates < 0) {
                $start_date = $start_date->subtract('days', $subDates);
            }
            $currentMonth_start_dates = $start_date->format('Y-m-d');
            $currentMonth_end_dates = $end_date->format('Y-m-d');
            $upcoming_sessions = CustomerToTrainer::with(['customer', 'trainer', 'reviews', 'request_session' => function ($q) {
                $q->where('request_by', '!=', 'trainer');
            }])
                ->where('customer_id', $get_cust_id->id)
                //->whereBetween('trainer_date', [$currentMonth_start_dates, $currentMonth_end_dates])
                ->whereNotIn('status', ['completed', 'canceled', 'cancelled'])
                ->orderBy('trainer_date','ASC')
                ->orderBy('trainer_time', 'ASC')
                ->get()
                ->map(function ($item) use ($now) {
                    $item_zone = $item->timeZone->timezone_value ?? $now->getTimezone();
                    $zone = $item->customer->timeZone->timezone_value ?? $item_zone;
                    $dt = $item->trainer_date . " " . $item->trainer_time;
                    if (Carbon::hasFormat($dt, "Y-m-d H:i:s")) {
                        $item->date_time_carbon = Carbon::createFromFormat(
                            "Y-m-d H:i:s",
                            $dt,
                            $item_zone
                        );
                        $item->converted_time = (clone $item->date_time_carbon)->setTimezone($zone);
                    }elseif (Carbon::hasFormat($dt, "Y-m-d H:i")){
                        $item->date_time_carbon = Carbon::createFromFormat(
                            "Y-m-d H:i",
                            $dt,
                            $item_zone
                        );
                        $item->converted_time = (clone $item->date_time_carbon)->setTimezone($zone);
                    }
                    return $item;
                })
                ->groupBy(function ($item) {
                    return $item->trainer_date . "_" . $item->trainer_time;
                })
                ->map(function ($item) {
                    return $item[0];
                });
            $data = view('customer.upcoming-sessions', compact('upcoming_sessions'))->render();
            return response()->json(['data' => $data]);
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function profile()
    {
        $trainer = '';
        $customer = Customer::where('user_id', Auth()->id())->first();
        $timezones = TimeZone::all();

        if (isset($customer->trainer->trainer_id)) {
            $trainer = Trainer::where('id', $customer->trainer->trainer_id)->first();
        }
        return view('customer.profile', compact('customer', 'trainer', 'timezones'));
    }

    public function ProfileEdit()
    {
        $customer = Customer::with('trainer')->where('user_id', Auth()->id())->first();
        return view('customer.profile-edit', compact('customer'));
    }

    public function ProfileUpdate(Request $request)
    {
        try {
            $file_name = "";
            $dirPath = "uploads/images/home";

            $customer = Customer::find($request->customer_id);
            $customer->first_name = $request->first_name;
            $customer->last_name = $request->last_name;
            $customer->email = $request->email;
            $customer->phone = $request->phone;
            $customer->gender = $request->gender;
            $customer->dob = $request->dob;
            $customer->age = $request->age;
            $customer->weight = $request->weight;
            $customer->nationality = $request->nationality;
            $customer->residence = $request->residence;
            $customer->city = $request->city;
            $customer->timezone = $request->timezone;
            // $customer->days        = $request->days;
            // $customer->sessions_in_week =  $request->sessions_in_week;
            // $customer->training_type =  $request->training_type;
            if ($request->hasFile('photo')) {
                if (File::exists(public_path($dirPath . '/' . $request->photo))) {
                    File::delete(public_path($dirPath . '/' . $request->photo));
                }
                $fileName = time() . '-' . $request->photo->getClientOriginalName();
                $request->photo->move(public_path($dirPath), $fileName);

                $customer->photo = $dirPath . '/' . $fileName;
            }
            $customer->save();

            return redirect('customer/profile')->with('success', 'Profile Updated Successfully.');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function Contract()
    {
        return view('customer.contract');
    }

    public function SubmitContract(Request $request)
    {
        try {
            $dirPath = "uploads/contract";
            $get_cust_id = Customer::where('user_id', Auth::user()->id)->pluck('id')->first();

            $contract = new Contract();
            $contract->customer_id = $get_cust_id;
            $contract->field1 = $request->field1;
            $contract->field2 = $request->field2;
            $contract->field3 = $request->field3;
            $contract->company_name = $request->company_name;
            $contract->company_date = $request->company_date;
            $contract->client_name = $request->client_name;
            $contract->client_date = $request->client_date;
            // $contract->field4            = $request->field4;
            // $contract->field5            = $request->field5;
            // $contract->session_duration  = $request->session_duration;
            // $contract->total_sessions    = $request->total_sessions;
            // $contract->session_price     = $request->session_price;
            // $contract->discounted_price  = $request->discounted_price;
            // $contract->no_of_days        = $request->no_of_days;
            // $contract->company_signature = $request->company_signature;

            if ($request->hasFile('client_siganture')) {
                if (File::exists(public_path($dirPath . '/' . $request->client_siganture))) {
                    File::delete(public_path($dirPath . '/' . $request->client_siganture));
                }
                $fileName = time() . '-' . $request->client_siganture->getClientOriginalName();
                $request->client_siganture->move(public_path($dirPath), $fileName);
                $contract->client_siganture = $dirPath . '/' . $fileName;
            }

            // if($request->hasFile('company_signature'))
            // {
            //     if(File::exists(public_path($dirPath.'/'.$request->company_signature))){
            //         File::delete(public_path($dirPath.'/'.$request->company_signature));
            //     }
            //     $fileName = time().'-'.$request->company_signature->getClientOriginalName();
            //     $request->company_signature->move(public_path($dirPath), $fileName);
            //     $contract->company_signature  = $dirPath.'/'.$fileName;
            // }
            $contract->save();

            // Customer::where('user_id', Auth::id())->update(['type'=>'permanent']);

            return redirect()->back()->with('success', 'Contract Submitted successfully..!!');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function PerformanceDetail($id)
    {

        $detail = Performance::with('customer')->where('session_id', $id)->first();
        return view('customer.performance_detail', compact('detail'));
    }

    public function Payments()
    {
        $get_cust_id = Customer::where('user_id', Auth::user()->id)->pluck('id')->first();
        $payments = Payment::where('customer_id', $get_cust_id)->get();

        return view('customer.payments', compact('payments'));
    }

    public function Payment(Request $request)
    {
        try {
            $update_payment = Payment::find($request->payment_id);
            $update_payment->status = "paid";
            $update_payment->save();

            return redirect()->back()->with('success', 'Payment successfully..!!');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function Sessions()
    {
        $get_cust_id = Customer::where('user_id', Auth::user()->id)->pluck('id')->first();
        $sessions = CustomerToTrainer::with('timeZone', 'customer', 'trainer', 'sessions', 'reviews')->where('customer_id', $get_cust_id)->get();
        return view('customer.sessions', compact('sessions'));
    }

    public function CancelSession(Request $request)
    {

        $update_status = CustomerToTrainer::find($request->customer_to_trainer_id);
        $update_status->status = "canceled";
        $update_status->save();

        return redirect()->back()->with('success', 'Session Canceled Successfully..!!');

    }

    public function AddReview(Request $request)
    {

        $get_cust_id = Customer::where('user_id', Auth::user()->id)->pluck('id')->first();

        $add_review = new Review();
        $add_review->customer_id = $get_cust_id;
        $add_review->session_id = $request->session_id;
        $add_review->trainer_id = $request->trainer_id;
        $add_review->cust_to_trainer_id = $request->cust_to_trainer_id;
        $add_review->name = $request->name;
        $add_review->rating = $request->rating;
        $add_review->review = $request->review;

        $add_review->save();

        return redirect()->back()->with('success', 'Review Submitted Successfully..!!');

    }

}
