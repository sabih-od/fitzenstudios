<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\CustomerToTrainer;
use App\Models\Notification;
use App\Models\RescheduleRequest;
use App\Models\TimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SessionController extends Controller
{
    public function index (Request $request)
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

    public function reschedule (Request $request)
    {
        try {
            DB::beginTransaction();
            $check = RescheduleRequest::where('customer_to_trainer_id', $request->session_id)->where('request_by', $request->request_by == 'customer' ? 'customer' : 'trainer')->first();
            $session = CustomerToTrainer::where('id', $request->session_id)->first();
            //$time_zone = $session->time_zone;

//            $time_zone = $request->request_by_timezone;
            $time_zone = TimeZone::where('timezone_value', $request->request_by_timezone)->first()->id ?? null;

            if ($check == null) {
                $session_request                         = new RescheduleRequest();
                $session_request->customer_to_trainer_id = $request->session_id;
                $session_request->request_by             = $request->request_by;
                $session_request->new_session_date       = $request->new_session_date;
                $session_request->new_session_time       = date('h:i:s', strtotime($request->new_session_time));
                $session_request->time_zone              = $time_zone;
                $session_request->reason                 = $request->reason;
                $session_request->save();

                $notification               = new Notification();
                $notification->sender_id    = Auth::user()->id;
                $notification->receiver_id  = 1;
                $notification->notification = "Demo Request is Re-Scheduled by ".$request->request_by;
                $notification->type         = "ReSchedule Session";
                $notification->save();

                DB::commit();
                return response()->json([
                    'success' => 'Request Added successfully'
                ]);
            } else {
                $session_request                         = RescheduleRequest::find($check->id);
                $session_request->customer_to_trainer_id = $request->session_id;
                $session_request->request_by             = $request->request_by;
                $session_request->new_session_date       = $request->new_session_date;
                $session_request->new_session_time       = date('h:i:s', strtotime($request->new_session_time));
                $session_request->time_zone              = $time_zone;
                $session_request->reason                 = $request->reason;
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
}
