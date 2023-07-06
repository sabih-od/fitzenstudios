<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\AdminAssignCustomer;
use App\Mail\AdminAssignTrainer;
use App\Models\BookDemoSession;
use App\Models\Customer;
use App\Models\CustomerToTrainer;
use App\Models\Notification;
use App\Models\RescheduleRequest;
use App\Models\TimeZone;
use App\Models\Trainer;
use App\Traits\PHPCustomMail;
use App\Traits\ZoomMeetingTrait;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use DateTime;
use DateTimeZone;
use File;


class SessionController extends Controller
{
    use ZoomMeetingTrait , PHPCustomMail;

    const MEETING_TYPE_INSTANT = 1;
    const MEETING_TYPE_SCHEDULE = 2;
    const MEETING_TYPE_RECURRING = 3;
    const MEETING_TYPE_FIXED_RECURRING_FIXED = 8;

    public function index(Request $request)
    {
        try {
            $get_cust_id = Customer::where('user_id', Auth::user()->id)->pluck('id')->first();
            $sessions = CustomerToTrainer::with('timeZone', 'customer', 'trainer', 'sessions', 'reviews')->where('customer_id', $get_cust_id)->get();

            return response()->json($sessions);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }


    public function createSession(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'trainer_id' => ['required', Rule::exists('trainers', 'id')],
            'customer_id' => ['required', 'array', function ($attr, $value, $fail) {
                if (!$value || !is_array($value)) {
                    return;
                }
            }],
            'session_type' => 'required',
            'trainer_date.*' => 'required',
            'trainer_time.*' => 'required',
            'time_zone' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->getMessageBag());
        }

        try {
            DB::beginTransaction();

            $trainer_id = $request->trainer_id;
            $trainer = Trainer::where('id', $trainer_id)->first();
            $customer = Customer::whereIn('id', $request->customer_id)->get();
            if(!$customer){
                return response()->json([
                    'error' => 'Customer not found'
                ]);
            }
            foreach ($customer as $value) {
                foreach ($request->trainer_date as $key => $trainer_date) {
                    $trainerAssignedTime = Carbon::parse($request->trainer_time[$key])->format('H:i:s');
                    $timezone = TimeZone::where('time_zone' , $request->time_zone)->first();
                    if(!$timezone){
                        return response()->json([
                            'error' => 'Given Time Zone not found'
                        ]);
                    }
                    $date = new DateTime($request->trainer_date[$key] . '' . $trainerAssignedTime, new DateTimeZone($timezone->timezone_value));
                    $date->setTimezone(new DateTimeZone($timezone->timezone_value));
                    $sessionDate = $date->format('Y-m-d');
                    $sessionTime = $date->format('H:i:s');
                    $sessionDateTime = $sessionDate . '' . $sessionTime;

                    $resp = $this->create([
                        "topic" => $request->session_type,
                        "start_time" => $sessionDateTime,
                        "duration" => 180,
                        "agenda" => "Weekly Session",
                        "host_video" => "",
                        "participant_video" => "",
                        "time_zone" => $timezone->timezone_value
                    ]);
                    $trainerDate = new DateTime($sessionDateTime, new DateTimeZone($resp['data']['timezone']));
                    $trainerDate->setTimezone(new DateTimeZone($trainer->timeZone->timezone_value));
                    $trainer_timezone_date = $trainerDate->format('Y-m-d');
                    $trainer_timezone_time = $trainerDate->format('H:i:s');

                    $customerDate = new DateTime($sessionDateTime, new DateTimeZone($resp['data']['timezone']));
                    $customerDate->setTimezone(new DateTimeZone($value->timeZone->timezone_value));
                    $customer_timezone_date = $customerDate->format('Y-m-d');
                    $customer_timezone_time = $customerDate->format('H:i:s');

                    $customerData = [
                        'name' => $value->first_name . ' ' . $value->last_name,
                        'trainer' => $trainer['name'],
                        'join_url' => $resp["data"]["join_url"],
                        'start_url' => $resp["data"]["start_url"],
                        'start_date' => date('d-m-Y', strtotime($customer_timezone_date)),
                        'start_time' => $customer_timezone_time
                    ];

                    Mail::to($value->email)->send(new AdminAssignCustomer($customerData));

                    $trainerData = [
                        'name' => $trainer['name'],
                        'start_url' => $resp["data"]["start_url"],
                        'start_date' => date('d-m-Y', strtotime($trainer_timezone_date)),
                        'start_time' => $trainer_timezone_time
                    ];

                    Mail::to($trainer['email'])->send(new AdminAssignTrainer($trainerData));

                    $cust_to_trainer = new CustomerToTrainer();
                    $cust_to_trainer->start_url = $resp["data"]["start_url"];
                    $cust_to_trainer->join_url = $resp["data"]["join_url"];
                    $cust_to_trainer->meeting_id = $resp["data"]["id"];
                    $cust_to_trainer->customer_id = $value->id;
                    $cust_to_trainer->trainer_id = $trainer_id;
                    $cust_to_trainer->trainer_date = $request->trainer_date[$key];
                    $cust_to_trainer->trainer_time = $trainerAssignedTime;
                    $cust_to_trainer->time_zone = $request->time_zone;
                    $cust_to_trainer->notes = $request->notes;
                    $cust_to_trainer->session_type = $request->session_type;
                    $cust_to_trainer->trainer_timezone_date = $trainer_timezone_date;
                    $cust_to_trainer->trainer_timezone_time = $trainer_timezone_time;
                    $cust_to_trainer->customer_timezone_date = $customer_timezone_date;
                    $cust_to_trainer->customer_timezone_time = $customer_timezone_time;
                    $cust_to_trainer->save();

                    $notify = "You have a new session request by admin.";

                    $notification = new Notification();
                    $notification->sender_id = FacadesAuth::user()->id;
                    $notification->receiver_id = $value->user_id;
                    $notification->notification = $notify;
                    $notification->type = "Session Request";
                    $notification->save();

                    $notification_trainer = new Notification();
                    $notification_trainer->sender_id = FacadesAuth::user()->id;
                    $notification_trainer->receiver_id = $trainer->user_id;
                    $notification_trainer->notification = $notify;
                    $notification_trainer->type = "Session Request";
                    $notification_trainer->save();


                }
            }
            DB::commit();
            return response()->json([
                'success' => 'Trainer Assigned Successfully'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }

    }


    public function reschedule(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'session_id' => 'required',
            'request_by' => 'required',
            'request_by_timezone' => 'required',
            'new_session_date' => 'required',
            'new_session_time' => 'required',
            'reason' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->getMessageBag());
        }

        try {
            DB::beginTransaction();
            $check = RescheduleRequest::where('customer_to_trainer_id', $request->session_id)->where('request_by', $request->request_by == 'customer' ? 'customer' : 'trainer')->first();
            $session = CustomerToTrainer::where('id', $request->session_id)->first();
            //$time_zone = $session->time_zone;

//            $time_zone = $request->request_by_timezone;
            $time_zone = TimeZone::where('timezone_value', $request->request_by_timezone)->first()->id ?? null;

            if ($check == null) {
                $session_request = new RescheduleRequest();
                $session_request->customer_to_trainer_id = $request->session_id;
                $session_request->request_by = $request->request_by;
                $session_request->new_session_date = $request->new_session_date;
                $session_request->new_session_time = date('h:i:s', strtotime($request->new_session_time));
                $session_request->time_zone = $time_zone;
                $session_request->reason = $request->reason;
                $session_request->save();

                $notification = new Notification();
                $notification->sender_id = Auth::user()->id;
                $notification->receiver_id = 1;
                $notification->notification = "Demo Request is Re-Scheduled by " . $request->request_by;
                $notification->type = "ReSchedule Session";
                $notification->save();

                DB::commit();
                return response()->json([
                    'success' => 'Request Added successfully'
                ]);
            } else {
                $session_request = RescheduleRequest::find($check->id);
                $session_request->customer_to_trainer_id = $request->session_id;
                $session_request->request_by = $request->request_by;
                $session_request->new_session_date = $request->new_session_date;
                $session_request->new_session_time = date('h:i:s', strtotime($request->new_session_time));
                $session_request->time_zone = $time_zone;
                $session_request->reason = $request->reason;
                $session_request->save();

                DB::commit();

                return response()->json([
                    'success' => 'Request Added successfully'
                ]);
            }
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function joinZoomMeeting(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'session_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->getMessageBag());
        }

        try {
            $session = CustomerToTrainer::find($request->session_id);

            if (!$session || is_null($session->start_url)) {
                return response()->json([
                    'error' => 'Session/Meeting Url not found'
                ]);
            }

            return response()->json($session->start_url);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage()
            ]);
        }
    }

    public function CancelSession(Request $request)
    {
        try {
            $update_status = CustomerToTrainer::find($request->customer_to_trainer_id);

            if(!$update_status){
                return response()->json([
                    'error' => 'Session Not Found..!!'
                ]);
            }

            $update_status->status = "canceled";
            $update_status->save();
            return response()->json([
                'success' => 'Session Cancelled Successfully..!!'
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                'error' => $exception->getMessage()
            ]);
        }
    }


    public function bookDemoSession(Request $request) {
        $customer = Customer::where('user_id', Auth::user()->id)->first();
        $check    = BookDemoSession::where('customer_id', $customer->id)->first();
        if($check == null) {
            try {
                //code...
                $demo               = new BookDemoSession();
                $demo->time_zone    = $request->time_zone;
                $demo->first_name   = $request->first_name;
                $demo->last_name    = $request->last_name;
                $demo->email        = $request->email;
                $demo->phone        = $request->phone;
                $demo->session_date = $request->session_date;
                $demo->session_time = date('h:i:s', strtotime($request->session_time));
                $demo->goals        = $request->goals;
                $demo->message      = $request->message;
                $demo->customer_id  = $customer->id;
//                $demo->save();
                $mailData = array(
                    'first_name'   => $request->first_name,
                    'last_name'    => $request->last_name,
                    'email'        => $request->email,
                    'phone'        => $request->phone,
                    'session_date' => $request->session_date,
                    'session_time' => $request->session_time,
                    'goals'        => $request->goals,
                    'user_message' => $request->message,
                    'to'           => config("app.mail_from_address"),
                );

                Mail::send('front.emails.session_request', $mailData, function($message) use($mailData){
                    $message->to($mailData['to'])->subject('Fitzen Studio - Session Request');
                });


                $notify = "You have a new demo request from ".$request->first_name.' '.$request->last_name;
                $notification               = new Notification();
                $notification->sender_id    = Auth::user()->id;
                $notification->receiver_id  = 1;
                $notification->notification = $notify;
                $notification->type         = "Demo Request";
                $notification->save();
                Customer::where('user_id', Auth::id())->update(['is_lead' => 0]);
                return response()->json([
                    'success' => 'Welcome you onboard! We will get back to you shortly.'
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'error' => $e->getMessage()
                ]);
            }
        } else {
            return response()->json([
                'error' => 'You already submitted request for demo session..!!'
            ]);
        }
    }

}
