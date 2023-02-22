<?php

namespace App\Http\Controllers\Trainer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Trainer;
use App\Models\CustomerToTrainer;
use App\Models\CustomerDetail;
use App\Models\Performance;
use App\Models\Notification;
use App\Models\Customer;
use Carbon\Carbon;
use App\Models\BookDemoSession;
use App\Models\TimeZone;
use App\Models\PaymentToTrainer;

//use Illuminate\Facades\Support\DB;
use DB;
use App\Traits\ZoomMeetingTrait;
use Firebase\JWT\JWT;
use GuzzleHttp\Client;
use Auth;
use File;
use Mail;

class TrainerPortalController extends Controller
{
    use ZoomMeetingTrait;

    const MEETING_TYPE_INSTANT = 1;
    const MEETING_TYPE_SCHEDULE = 2;
    const MEETING_TYPE_RECURRING = 3;
    const MEETING_TYPE_FIXED_RECURRING_FIXED = 8;

    public function dashboard()
    {
        $now = Carbon::now();
        $currentMonth_start = $now->startOfMOnth()->format('Y-m-d');
        $currentMonth_end = $now->endOfMOnth()->format('Y-m-d');

        $user_id = Auth::user()->id;
        $get_trainer_id = Trainer::where('user_id', $user_id)->pluck('id')->first();
//        dd($get_trainer_id);

        $upcoming_sessions = CustomerToTrainer::with('customer', 'trainer')
            ->whereBetween('trainer_date', [$currentMonth_start, $currentMonth_end])
            ->where('trainer_id', $get_trainer_id)->where('status', '!=', 'completed')
            ->where('status', '!=', 'canceled')
            ->orderBy('trainer_date')
            ->get()
            ->map(function ($item) use ($now) {
                $item_zone = $item->timeZone->timezone_value ?? $now->getTimezone();
                $zone = $item->trainer->timeZone->timezone_value ?? $item_zone;

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

//        $new_upcoming_sessions = $upcoming_sessions->groupBy(function ($item) {
//
//            return $item->trainer_date . "_" . $item->trainer_time;
//        });

        $demo_data = [];
        $i = 0;
        foreach ($upcoming_sessions as $demo) {
            $demo_data[$i]['id'] = $demo->id;
            $demo_data[$i]['title'] = $demo->session_type;//$demo->goals;
            $demo_data[$i]['start'] = $demo->converted_time->format('Y-m-d');
            $demo_data[$i]['description'] = $demo->notes;
            $i++;
        }


        return view('trainer.dashboard', compact('upcoming_sessions', 'demo_data'));
    }

    public function calendardatafetch(Request $request)
    {

        $now = Carbon::now();
        $user_id = \Illuminate\Support\Facades\Auth::user()->id;
        $get_trainer_id = Trainer::where('user_id', $user_id)->pluck('id')->first();
        $trainer_zone = $get_trainer_id->timeZone->timezone_value ?? $now->getTimezone();
        $now->setTimezone($trainer_zone);

        $start_date = Carbon::createFromFormat('D M d Y', $request->start_date, $trainer_zone);
        $end_date = Carbon::createFromFormat('D M d Y', $request->end_date, $trainer_zone)->subDay();

        $subDates = $now->diffInDays($start_date, false);
        if ($subDates < 0) {
            $start_date = $start_date->subtract('days', $subDates);
        }

        $currentMonth_start_dates = $start_date->format('Y-m-d');
        $currentMonth_end_dates = $end_date->format('Y-m-d');

        $upcoming_sessions = CustomerToTrainer::with('customer', 'trainer')
            ->whereBetween('trainer_date', [$currentMonth_start_dates, $currentMonth_end_dates])
//            ->where('trainer_date',$currentMonth_start_dates)
            ->where('trainer_id', $get_trainer_id)
            ->where('status', '!=', 'completed')
            ->where('status', '!=', 'canceled')
            ->orderBy('trainer_date')
            ->get()
            ->map(function ($item) use ($now) {
                $item_zone = $item->timeZone->timezone_value ?? $now->getTimezone();
                $zone = $item->trainer->timeZone->timezone_value ?? $item_zone;

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
            });


        $new_upcoming_sessions = $upcoming_sessions->groupBy(function ($item) {
            return $item->trainer_date . "_" . $item->trainer_time;
        });

        $data = view('trainer.upcoming-sessions', compact('upcoming_sessions', 'new_upcoming_sessions'))->render();
        return response()->json(['data' => $data]);


    }

    public function EditProfile($id)
    {
        $timezones = TimeZone::get();
        $trainer = Trainer::find($id);
        return view('trainer.profile', compact('trainer', 'timezones'));
    }

    public function ProfileUpdate(Request $request)
    {

        $dirPath = "uploads/images/home";

        $update_trainer = Trainer::find($request->trainer_id);
        $update_trainer->name = $request->name ? $request->name : '';
        $update_trainer->last_name = $request->last_name ? $request->last_name : '';
        $update_trainer->phone = $request->phone;
        $update_trainer->gender = $request->gender;
        $update_trainer->dob = $request->dob;
        $update_trainer->age = $request->age;
        $update_trainer->weight = $request->weight;
        $update_trainer->nationality = $request->nationality;
        $update_trainer->country = $request->country;
        $update_trainer->city = $request->city;
        if ($request->days_available) {
            $update_trainer->days_available = json_encode($request->days_available);
        }
        $update_trainer->no_of_session_in_week = $request->no_of_session_in_week;
        $update_trainer->description = $request->description;
        $update_trainer->time_zone = $request->time_zone;


        if ($request->hasFile('photo')) {
            if (File::exists(public_path($dirPath . '/' . $request->photo))) {
                File::delete(public_path($dirPath . '/' . $request->photo));
            }
            $fileName = time() . '-' . $request->photo->getClientOriginalName();
            $request->photo->move(public_path($dirPath), $fileName);

            $update_trainer->photo = $dirPath . '/' . $fileName;
        }
        $update_trainer->save();
        return redirect()->back()->with('success', 'Trainer Updated Successfully.');
    }

    public function JoinMeeting($id)
    {
        return view('trainer.join_meeting');
    }

    public function AddCustomerDetails($id)
    {

        $time_zones = TimeZone::all();
        $get_name = Trainer::where('user_id', Auth::user()->id)->first();
        $cust_name = Customer::find($id);
        return view('trainer.add_customer_detail', compact('id', 'time_zones', 'get_name', 'cust_name'));
    }

    public function UpdateCustomerDetails(Request $request)
    {

        $check = CustomerDetail::where('trainer_id', Auth::user()->id)->where('customer_id', $request->customer_id)->first();
        $user_id = Auth::user()->id;
        $trainer_id = Trainer::where('user_id', $user_id)->first();

        if ($check == null) {

            $detail = new CustomerDetail();
            $detail->customer_name = $request->customer_name;
            $detail->trainer_name = $request->trainer_name;
            $detail->feedback = $request->feedback;
            $detail->save();

            // $detail->trainer_id              = $trainer_id;
            // $detail->customer_id             = $request->customer_id;
            // $detail->owns_fitness_tracker    = $request->owns_fitness_tracker;
            // $detail->time_band               = $request->time_zone;
            // $detail->detail_time             = $request->detail_time;
            // $detail->training_type           = $request->training_type;
            // $detail->trainer_assigned        = $request->trainer_assigned;
            // $detail->total_sessions_in_week  = $request->total_sessions_in_week;

            // if ($request->fitness_type) {
            //     $detail->fitness_type        = json_encode($request->fitness_type);
            // }
            // if ($request->injuries) {
            //     $detail->injuries           = json_encode($request->injuries);
            // }
            // if ($request->med_conditions) {
            //     $detail->med_conditions     = json_encode($request->med_conditions);
            // }
            // if ($request->on_medication) {
            //     $detail->on_medication      = json_encode($request->on_medication);
            // }

            // $detail->period                  = $request->period;
            // $detail->workout_experience      = $request->workout_experience;
            // $detail->life_style              = $request->life_style;
            // $detail->focus_of_workout        = $request->focus_of_workout;
            // $detail->workout_type            = $request->workout_type;
            // $detail->medical_condition       = $request->medical_condition;


            $notification = new Notification();
            $notification->sender_id = Auth::user()->id;
            $notification->receiver_id = 1;
            $notification->notification = Auth::user()->name . " just added customer detail";
            $notification->type = "Trainer Add Customer Details";
            $notification->save();

        } else {

            $detail = CustomerDetail::find($check->id);
            $detail->customer_name = $request->customer_name;
            $detail->trainer_name = $request->trainer_name;
            $detail->feedback = $request->feedback;
            $detail->save();

            $notification = new Notification();
            $notification->sender_id = Auth::user()->id;
            $notification->receiver_id = 1;
            $notification->notification = Auth::user()->name . " just added customer detail";
            $notification->type = "Trainer Updated Customer Details";
            $notification->save();
        }


        return redirect('trainer/dashboard')->with('success', 'Customer Detail Added successfully...!!');
    }

    public function CustomerDetails()
    {
        $user_id = Auth::user()->id;
        $trainer_id = Trainer::where('user_id', $user_id)->pluck('id')->first();
        $details = CustomerDetail::with('customers')->where('trainer_id', $trainer_id)->get();
        return view('trainer.customer_detail', compact('details'));
    }

    public function Payments()
    {

        $get_trainer_id = Trainer::where('user_id', Auth::id())->pluck('id')->first();
        $payments = PaymentToTrainer::where('trainer_id', $get_trainer_id)->orderBy('id', 'DESC')->get();
        return view('trainer.payments', compact('payments'));
    }

    public function Performance()
    {

        $user_id = Auth::user()->id;
        $get_trainer_id = Trainer::where('user_id', $user_id)->pluck('id')->first();
        $upcoming_sessions = CustomerToTrainer::with('customer', 'trainer')->where('trainer_id', $get_trainer_id)->get();
        return view('trainer.performance', compact('upcoming_sessions'));
    }

    public function UpdateSessionStatus(Request $request)
    {

        $update = CustomerToTrainer::find($request->session_id);
//        dd($update);

        $update->status = $request->status;
        $update->update();

        return redirect()->back()->with('success', 'Session Status Updated successfully...!!');
    }

    public function AddCustomerPerformance($id)
    {
        $performance = Performance::where('session_id', $id)->first();
        return view('trainer.add_performance', compact('id', 'performance'));
    }

    public function AddPerformance(Request $request)
    {

        $get_demo_session_id = CustomerToTrainer::where('id', $request->session_id)->pluck('demo_session_id')->first();
        $check_performance = Performance::where('demo_session_id', $get_demo_session_id)->first();

        if ($check_performance == null) {

            $get_cust_id = CustomerToTrainer::where('id', $request->session_id)->pluck('customer_id')->first();

            $performance = new Performance();
            $performance->demo_session_id = $get_demo_session_id;
            $performance->session_id = $request->session_id;
            $performance->trainer_id = Auth::user()->id;;
            $performance->customer_id = $get_cust_id;
            $performance->time_login = $request->time_login;
            $performance->time_logout = $request->time_logout;
            $performance->per_workout_meal = $request->per_workout_meal;
            $performance->hours_of_sleep_prev_day = $request->hours_of_sleep_prev_day;
            $performance->step_count_prev_day = $request->step_count_prev_day;
            $performance->prev_day_activity = $request->prev_day_activity;
            $performance->calories_count_during_session = $request->calories_count_during_session;
            $performance->any_aches_or_pains = $request->any_aches_or_pains;
            $performance->mood_and_energy_level = $request->mood_and_energy_level;
            $performance->avg_heart_rate_during_session = $request->avg_heart_rate_during_session;
            $performance->time_taken = $request->time_taken;
            $performance->any_difficulty_noticed = $request->any_difficulty_noticed;
            $performance->no_of_reps_for_each_workout = $request->no_of_reps_for_each_workout;
            $performance->no_of_laps = $request->no_of_laps;
            $performance->stipulated_time = $request->stipulated_time;
            $performance->difficulty = $request->difficulty;
            $performance->additional_comments = $request->additional_comments;
            $performance->agility_workout = $request->agility_workout;
            $performance->agility_no_of_laps = $request->agility_no_of_laps;
            $performance->agility_stipulated_time = $request->agility_stipulated_time;
            $performance->agility_difficulty_noticed = $request->agility_difficulty_noticed;
            $performance->agility_add_comments = $request->agility_add_comments;
            $performance->resistance_workout = $request->resistance_workout;
            $performance->resistance_no_of_laps = $request->resistance_no_of_laps;
            $performance->resistance_stipulated_time = $request->resistance_stipulated_time;
            $performance->resistance_difficulty_noticed = $request->resistance_difficulty_noticed;
            $performance->resistance_add_comments = $request->resistance_add_comments;
            $performance->denomination = $request->denomination;
            $performance->type_of_props = $request->type_of_props;
            $performance->denomination_stipulated_time = $request->denomination_stipulated_time;
            $performance->denomination_add_comments = $request->denomination_add_comments;
            $performance->stretches_time_taken = $request->stretches_time_taken;
            $performance->stretches_difficulty_noticed = $request->stretches_difficulty_noticed;
            $performance->save();

            $notification = new Notification();
            $notification->sender_id = Auth::user()->id;
            $notification->receiver_id = 1;
            $notification->notification = Auth::user()->name . " just added customer performance";
            $notification->type = "Trainer Add Customer Performance";
            $notification->save();

            return redirect('trainer/dashboard')->with('success', 'Session Performance Added Successfully...!!');

        } else {

            $get_cust_id = CustomerToTrainer::where('id', $request->session_id)->pluck('customer_id')->first();

            $performance = Performance::find($check_performance->id);
            $performance->session_id = $request->session_id;
            $performance->trainer_id = Auth::user()->id;;
            $performance->customer_id = $get_cust_id;
            $performance->time_login = $request->time_login;
            $performance->time_logout = $request->time_logout;
            $performance->per_workout_meal = $request->per_workout_meal;
            $performance->hours_of_sleep_prev_day = $request->hours_of_sleep_prev_day;
            $performance->step_count_prev_day = $request->step_count_prev_day;
            $performance->prev_day_activity = $request->prev_day_activity;
            $performance->calories_count_during_session = $request->calories_count_during_session;
            $performance->any_aches_or_pains = $request->any_aches_or_pains;
            $performance->mood_and_energy_level = $request->mood_and_energy_level;
            $performance->avg_heart_rate_during_session = $request->avg_heart_rate_during_session;
            $performance->time_taken = $request->time_taken;
            $performance->any_difficulty_noticed = $request->any_difficulty_noticed;
            $performance->no_of_reps_for_each_workout = $request->no_of_reps_for_each_workout;
            $performance->no_of_laps = $request->no_of_laps;
            $performance->stipulated_time = $request->stipulated_time;
            $performance->difficulty = $request->difficulty;
            $performance->additional_comments = $request->additional_comments;
            $performance->agility_workout = $request->agility_workout;
            $performance->agility_no_of_laps = $request->agility_no_of_laps;
            $performance->agility_stipulated_time = $request->agility_stipulated_time;
            $performance->agility_difficulty_noticed = $request->agility_difficulty_noticed;
            $performance->agility_add_comments = $request->agility_add_comments;
            $performance->resistance_workout = $request->resistance_workout;
            $performance->resistance_no_of_laps = $request->resistance_no_of_laps;
            $performance->resistance_stipulated_time = $request->resistance_stipulated_time;
            $performance->resistance_difficulty_noticed = $request->resistance_difficulty_noticed;
            $performance->resistance_add_comments = $request->resistance_add_comments;
            $performance->denomination = $request->denomination;
            $performance->type_of_props = $request->type_of_props;
            $performance->denomination_stipulated_time = $request->denomination_stipulated_time;
            $performance->denomination_add_comments = $request->denomination_add_comments;
            $performance->stretches_time_taken = $request->stretches_time_taken;
            $performance->stretches_difficulty_noticed = $request->stretches_difficulty_noticed;
            $performance->save();

            $notification = new Notification();
            $notification->sender_id = Auth::user()->id;
            $notification->receiver_id = 1;
            $notification->notification = Auth::user()->name . " just updated customer performance";
            $notification->type = "Trainer Updated Customer Performance";
            $notification->save();

            return redirect('trainer/dashboard')->with('success', 'Session Performance Updated Successfully...!!');
        }
    }

    public function PerformanceDetail($id)
    {
        $detail = Performance::with('customer')->where('session_id', $id)->first();
        return view('trainer.performance_detail', compact('detail'));
    }

    public function Sessions()
    {
        $user_id = Auth::user()->id;
        $get_trainer_id = Trainer::where('user_id', $user_id)->pluck('id')->first();
        $upcoming_sessions = CustomerToTrainer::with('customer', 'trainer', 'sessions')->where('trainer_id', $get_trainer_id)->orderBy('id', 'DESC')->get();
        return view('trainer.sessions', compact('upcoming_sessions'));

    }

    public function CancelSession(Request $request)
    {
        $update_status = CustomerToTrainer::find($request->customer_to_trainer_id);
        $update_status->status = "canceled";
        $update_status->save();

        return redirect()->back()->with('success', 'Session Cancelled Successfully..!!');

    }

}
