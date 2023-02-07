<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Models\Performance;
use App\Models\Customer;
use App\Models\Trainer;
use App\Models\CustomerToTrainer;
use App\Models\BookDemoSession;
use App\Models\User;
use App\Models\RescheduleRequest;
use App\Models\CustomerDetail;
use App\Models\Notification;
use App\Traits\ZoomMeetingTrait;
use Firebase\JWT\JWT;
use GuzzleHttp\Client;
use App\Models\Contract;
use App\Models\Payment;
use App\Models\Lead;

use File;
use Auth;
use DateTime;
use DateTimeZone;
use Hash;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class AdminCustomerController extends Controller
{
    use ZoomMeetingTrait;

    const MEETING_TYPE_INSTANT = 1;
    const MEETING_TYPE_SCHEDULE = 2;
    const MEETING_TYPE_RECURRING = 3;
    const MEETING_TYPE_FIXED_RECURRING_FIXED = 8;

    public function index(Request $request)
    {
        $customers = Customer::where('is_lead', 0)->orderBy('id', 'DESC')->get();
        return view('admin.customers.index', compact('customers'));
    }

    public function CustomerRegistration(Request $request)
    {

        $check_user = User::where('email', $request->email)->first();
        if ($check_user == null) {

            $user = User::create([
                'name' => $request->f_name . ' ' . $request->l_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'role_id' => '2',
                'password' => Hash::make($request->password),
                'message' => $request->message,
            ]);

            Customer::create([
                'user_id' => $user->id,
                'first_name' => $request->f_name,//explode(' ', $user->name)[0],
                'last_name' => $request->l_name,//substr( $user->name, strpos( $user->name, " ") + 1),
                'email' => $user->email,
                'phone' => $user->phone,
                'time_zone' => $request->time_zone,
                "is_lead" => 0,
            ]);

            Lead::create([
                'user_id' => $user->id,
                'is_customer' => 0,
                'first_name' => $request->f_name,
                'last_name' => $request->l_name,
                'email' => $user->email,
                'phone' => $user->phone,
                'note' => $request->message,
            ]);

            $mailData = array(
                'to' => $request->email,
                'pass' => $request->password
            );
            Mail::send('front.emails.thankyou-signup-customer', $mailData, function ($message) use ($mailData) {
                $message->to($mailData['to'])->subject('Fitzen Studio - Signing Up');
            });

            return redirect()->back()->with('success', 'Customer created successfully...!!');

        } else {
            return redirect()->back()->with('error', 'Email already exist. Please try another one..!!');
        }
    }

    public function assignTrainer(Request $request)
    {

        $customer_id = $request->customer_id;
        $trainer_id = $request->trainer_id;
        $customer = Customer::where('id', $customer_id)->first();
        $trainer = Trainer::where('id', $trainer_id)->first();
        $exist = CustomerToTrainer::where('customer_id', $customer_id)->first();

        try {

            $date = new DateTime($request->trainer_date . '' . $request->trainer_time, new DateTimeZone($request->customer_timezone));
            $date->setTimezone(new DateTimeZone('America/New_York'));
            $sessionDate = $date->format('Y-m-d');
            $sessionTime = $date->format('H:i:s');

            $meeting_data = [
                "topic" => $request->session_type,
                "start_time" => $sessionDate . ' ' . $sessionTime,
                "duration" => 180,
                "agenda" => "demo session",
                "host_video" => "",
                "participant_video" => "",
                "time_zone" => 'America/New_York',
            ];

            $resp = $this->create($meeting_data);

            $trainerDate = new DateTime($sessionDate . '' . $sessionTime, new DateTimeZone($resp['data']['timezone']));
            $trainerDate->setTimezone(new DateTimeZone($trainer->time_zone));
            $trainer_timezone_date = $trainerDate->format('Y-m-d');
            $trainer_timezone_time = $trainerDate->format('H:i:s');

            $customerDate = new DateTime($sessionDate . '' . $sessionTime, new DateTimeZone($resp['data']['timezone']));
            $customerDate->setTimezone(new DateTimeZone($customer->time_zone));
            $customer_timezone_date = $customerDate->format('Y-m-d');
            $customer_timezone_time = $customerDate->format('H:i:s');

            // if($trainer->time_zone == "America/Washington") {

            //     date_default_timezone_set('America/Los_Angeles');
            //     $sess_time        = $request->trainer_date.' '.$request->trainer_time;
            //     $datetime         = new DateTime($sess_time);
            //     $trainer_timeZone = new DateTimeZone("America/Chicago");
            //     $datetime->setTimezone($trainer_timeZone);
            //     $trainer_timezone_date = $datetime->format('d-m-Y');
            //     // add one extra hour in time
            //     $train_time            = $datetime->format('H:i');
            //     $timestamp             = strtotime($train_time) + 60*60; // 10:09 + 1 hour
            //     $trainer_timezone_time =  date('H:i', $timestamp);

            // } else {

            //     date_default_timezone_set('America/Los_Angeles');
            //     $sess_time = $request->trainer_date.' '.$request->trainer_time;
            //     $datetime  = new DateTime($sess_time);
            //     // echo $datetime->format('Y-m-d H:i:s') . "<br>";
            //     $trainer_timeZone = new DateTimeZone($trainer->time_zone);
            //     $datetime->setTimezone($trainer_timeZone);
            //     $trainer_timezone_date =  $datetime->format('d-m-Y');
            //     $trainer_timezone_time =  $datetime->format('H:i');
            // }

            // if($customer->time_zone == "America/Washington") {

            //     $sesss_time            = $request->trainer_date.' '.$request->trainer_time;
            //     $newdatetime           = new DateTime($sesss_time);
            //     $customer_timeZone     = new DateTimeZone("America/Chicago");
            //     $newdatetime->setTimezone($customer_timeZone);
            //     $customer_timezone_date =  $newdatetime->format('d-m-Y');

            //     // add one extra hour in time
            //     $cust_time              = $datetime->format('H:i');
            //     $cust_timestamp         = strtotime($cust_time) + 60*60; // 10:09 + 1 hour
            //     $customer_timezone_time =  date('H:i', $cust_timestamp);

            // } else {

            //     $sesss_time            = $request->trainer_date.' '.$request->trainer_time;
            //     $newdatetime           = new DateTime($sesss_time);
            //     $customer_timeZone     = new DateTimeZone($customer->time_zone);
            //     $newdatetime->setTimezone($customer_timeZone);
            //     $customer_timezone_date =  $newdatetime->format('d-m-Y');
            //     $customer_timezone_time =  $newdatetime->format('H:i');
            // }

            $mailData_customer = array(
                'to' => $customer['email'],
                'name' => $customer['first_name'] . ' ' . $customer['last_name'],
                'trainer' => $trainer['name'],
                'join_url' => $resp["data"]["join_url"],
                // "start_date" => date('d-m-Y', strtotime($request->input('trainer_date'))),
                // "start_time" => $request->input('trainer_time'),
                "start_date" => $customer_timezone_date,
                "start_time" => $customer_timezone_time,

            );

            $mailData_trainer = array(
                'to' => $trainer['email'],
                'name' => $trainer['name'],
                'customer' => $customer['first_name'] . ' ' . $customer['last_name'],
                'start_url' => $resp["data"]["start_url"],
                // "start_date" => date('d-m-Y', strtotime($request->input('trainer_date'))),
                // "start_time" => $request->input('trainer_time'),
                "start_date" => $trainer_timezone_date,
                "start_time" => $trainer_timezone_time,
            );

            Mail::send('admin.emails.assigntrainer-customer', $mailData_customer, function ($message) use ($mailData_customer) {
                $message->to($mailData_customer['to'])->subject('Fitzen Studio - Assign Trainer');
            });

            Mail::send('admin.emails.assigntrainer-trainer', $mailData_trainer, function ($message) use ($mailData_trainer) {
                $message->to($mailData_trainer['to'])->subject('Fitzen Studio - Assign Trainer');
            });

            if ($exist != null) {

                CustomerToTrainer::where('customer_id', $customer_id)->update([
                    'start_url' => $resp["data"]["start_url"],
                    'join_url' => $resp["data"]["join_url"],
                    'meeting_id' => $resp["data"]["id"],
                    'trainer_id' => $trainer_id,
                    'trainer_date' => $request->trainer_date,
                    'trainer_time' => $request->trainer_time,
                    'notes' => $request->notes,
                    'session_type' => $request->session_type,
                    'trainer_timezone_date' => $trainer_timezone_date,
                    'trainer_timezone_time' => $trainer_timezone_time,
                    'customer_timezone_date' => $customer_timezone_date,
                    'customer_timezone_time' => $customer_timezone_time,
                    'time_zone' => $request->customer_timezone
                ]);

            } else {

                CustomerToTrainer::create([
                    'demo_session_id' => (int)$request->session_id,
                    'start_url' => $resp["data"]["start_url"],
                    'join_url' => $resp["data"]["join_url"],
                    'meeting_id' => $resp["data"]["id"],
                    'customer_id' => $customer_id,
                    'trainer_id' => $trainer_id,
                    'trainer_date' => $request->trainer_date,
                    'trainer_time' => $request->trainer_time,
                    'notes' => $request->notes,
                    'session_type' => $request->session_type,
                    'trainer_timezone_date' => $trainer_timezone_date,
                    'trainer_timezone_time' => $trainer_timezone_time,
                    'customer_timezone_date' => $customer_timezone_date,
                    'customer_timezone_time' => $customer_timezone_time,
                    'time_zone' => $request->customer_timezone
                ]);

            }

            $update_status = BookDemoSession::find($request->session_id);
            $update_status->status = "trainer_assigned";
            $update_status->save();

            $notification_to_trainer = new Notification();
            $notification_to_trainer->sender_id = FacadesAuth::user()->id;
            $notification_to_trainer->receiver_id = $trainer->user_id;
            $notification_to_trainer->notification = "Admin assigned you a customer for demo session";
            $notification_to_trainer->type = "Assign customer to trainer";
            $notification_to_trainer->save();

            $notification_to_customer = new Notification();
            $notification_to_customer->sender_id = FacadesAuth::user()->id;
            $notification_to_customer->receiver_id = $customer->user_id;
            $notification_to_customer->notification = "Admin assigned you a trainer for your demo session request";
            $notification_to_customer->type = "Assign trainer to customer";
            $notification_to_customer->save();

            return redirect()->back()->with('success', 'Trainer assigned successfully.');

            //code...
        } catch (\Exception $e) {

            return redirect()->back()->with('error', $e->getMessage());

        }

    }

    public function Performance(Request $request)
    {

        $upcoming_sessions = CustomerToTrainer::with('customer', 'trainer')->get();
        return view('admin.performance', compact('upcoming_sessions'));
    }

    public function RescheduleRequests()
    {

        $all_requests = RescheduleRequest::with('sessions')->orderBy('id', 'DESC')->where('status', 'pending')->get();
        return view('admin.rescheduled_requests', compact('all_requests'));
    }

    public function DeleteRescheduleRequest(Request $request)
    {

        $delete_row = RescheduleRequest::where('id', $request->id)->delete();
        return redirect('admin/reschedule-requests')->with('success', 'Request Deleted Successfully..!!');
    }

    public function ApproveRequest($reschedule_id)
    {

        $reschedule_request = RescheduleRequest::find($reschedule_id);
        $session = CustomerToTrainer::find($reschedule_request->customer_to_trainer_id);

        $date = new DateTime($reschedule_request->new_session_date . '' . $reschedule_request->new_session_time, new DateTimeZone($reschedule_request->time_zone));
        $date->setTimezone(new DateTimeZone('America/New_York'));
        $sessionDate = $date->format('Y-m-d');
        $sessionTime = $date->format('H:i:s');

        $data = [
            "topic" => $session->session_type,
            "start_time" => $sessionDate . ' ' . $sessionTime,
            "duration" => 60,
            "agenda" => $reschedule_request->reason,
            "host_video" => " ",
            "participant_video" => " ",
            "time_zone" => 'America/New_York'
        ];

        $resp = $this->update($session->meeting_id, $data);

        if ($resp['success']) {
            $customer_id = $session->customer_id;
            $trainer_id = $session->trainer_id;
            $customer = Customer::where('id', $customer_id)->first();
            $trainer = Trainer::where('id', $trainer_id)->first();

            $customerDateTime = new DateTime($sessionDate . '' . $sessionTime, new DateTimeZone('America/New_York'));
            $customerDateTime->setTimezone(new DateTimeZone($customer->time_zone));
            $customerDate = $customerDateTime->format('Y-m-d');
            $customerTime = $customerDateTime->format('H:i:s');

            $trainerDateTime = new DateTime($sessionDate . '' . $sessionTime, new DateTimeZone('America/New_York'));
            $trainerDateTime->setTimezone(new DateTimeZone($trainer->time_zone));
            $trainerDate = $trainerDateTime->format('Y-m-d');
            $trainerTime = $trainerDateTime->format('H:i:s');

            $update_session = CustomerToTrainer::find($reschedule_request->customer_to_trainer_id);
            $update_session->trainer_date = $sessionDate;
            $update_session->trainer_time = $sessionTime;
            $update_session->status = "re-scheduled";
            $update_session->trainer_timezone_date = $trainerDate;
            $update_session->trainer_timezone_time = $trainerTime;
            $update_session->customer_timezone_date = $customerDate;
            $update_session->customer_timezone_time = $customerTime;
            $update_session->save();


            $update_status = RescheduleRequest::find($reschedule_id);
            $update_status->status = "Approved";
            $update_status->save();


            $mailData_customer = array(
                'to' => $customer['email'],
                'name' => $customer['first_name'] . ' ' . $customer['last_name'],
                'trainer' => $trainer['name'],
                'join_url' => $update_session->join_url,
                "start_date" => date('d-m-Y', strtotime($customerDate)),
                "start_time" => $customerTime,

            );

            $mailData_trainer = array(
                'to' => $trainer['email'],
                'name' => $trainer['name'],
                'customer' => $customer['first_name'] . ' ' . $customer['last_name'],
                'start_url' => $update_session->start_url,
                "start_date" => date('d-m-Y', strtotime($trainerDate)),
                "start_time" => $trainerTime,
            );

            Mail::send('admin.emails.assigntrainer-customer', $mailData_customer, function ($message) use ($mailData_customer) {
                $message->to($mailData_customer['to'])->subject('Fitzen Studio - Assign Trainer');
            });

            Mail::send('admin.emails.assigntrainer-trainer', $mailData_trainer, function ($message) use ($mailData_trainer) {
                $message->to($mailData_trainer['to'])->subject('Fitzen Studio - Assign Trainer');
            });

            $notification_to_trainer = new Notification();
            $notification_to_trainer->sender_id = FacadesAuth::user()->id;
            $notification_to_trainer->receiver_id = $trainer->user_id;
            $notification_to_trainer->notification = "Admin approved re-schedule session request";
            $notification_to_trainer->type = "Re-Schedule Session";
            $notification_to_trainer->save();

            $notification_to_customer = new Notification();
            $notification_to_customer->sender_id = FacadesAuth::user()->id;
            $notification_to_customer->receiver_id = $customer->user_id;
            $notification_to_customer->notification = "Admin approved re-schedule session request";
            $notification_to_customer->type = "Re-Schedule Session";
            $notification_to_customer->save();

            return redirect('admin/reschedule-requests')->with('success', 'Re-Scheduled Request approved successfully...!!');

        } else {
            return redirect()->back()->with('error', 'Oops! Something went wrong.');
        }

    }

    public function UpdateSessionStatus(Request $request)
    {

        $update = CustomerToTrainer::find($request->session_id);
        $update->status = $request->status;
        $update->save();

        return redirect()->back()->with('success', 'Session Status Updated successfully...!!');
    }

    public function PerformanceDetail($id)
    {
        $detail = Performance::with('customer')->where('session_id', $id)->first();
        return view('admin.performance_detail', compact('detail'));
    }

    public function CustomerDetail($customer_id)
    {

        $detail = Customer::find($customer_id);
        $cust_detail = CustomerDetail::where('customer_id', $customer_id)->first();
        $schedules = CustomerToTrainer::with('customer', 'trainer')->where('customer_id', $customer_id)->get();
        $performances = Performance::with('trainer', 'session')->where('customer_id', $customer_id)->get();
        $payments = Payment::where('customer_id', $customer_id)->orderBy('id', 'DESC')->get();


        return view('admin.customer_detail', compact('detail', 'schedules', 'cust_detail', 'performances', 'payments'));
    }

    public function destroy($id, Request $request)
    {
        $customer = Customer::find($id);
        CustomerToTrainer::where('customer_id', $id)->delete();
        BookDemoSession::where('customer_id', $id)->delete();

        $user_id = $customer->user_id;
        User::where('id', $user_id)->delete();
        $customer->delete();
        return redirect()->back()->with('success', 'Customer Deleted Successfully.');
    }

    public function profile($id)
    {
        $customer = Customer::find($id);
        return view('admin.customers.profile', compact('customer'));
    }

    public function Schedule(Request $request)
    {
        $trainers = Trainer::get();
        if ($request->ajax()) {
            $customer = Customer::with('trainer')->get();
            return datatables()->of($customer)
                ->addColumn('name', function ($data) {
                    $name = $data->first_name . ' ' . $data->last_name;
                    return $name;
                })
                ->addColumn('trainer', function ($data) use ($trainers) {
                    if (isset($data->trainer)) {
                        $train = $trainers->where('id', $data->trainer->trainer_id)->first();
                        return empty($train) ? '' : $train->name;
                    }
                    return '';
                    //return $data->traniner->name ?? '';
                })
                ->addColumn('trainer_date', function ($data) use ($trainers) {
                    if (isset($data->trainer->trainer_date)) {
                        return $data->trainer->trainer_date;
                    }
                    return '';
                })
                ->addColumn('trainer_time', function ($data) use ($trainers) {
                    if (isset($data->trainer->trainer_time)) {
                        return $data->trainer->trainer_time;
                    }
                    return '';
                })
                ->addColumn('action', function ($row) {
                    $btn = '<a class="btn btn-sm btn-info" href ="/admin/customer-profile/' . $row->id . '" >
                            <i class="fa fa-eye" aria-hidden="true"></i>
                        </a>
                        <button class="btn btn-sm btn-danger" onclick="Delete(' . $row->id . ');" >
                            <i class="fa fa-trash"></i>
                        </button>
                        <form action="' . route('customer.destroy', $row->id) . '" method="POST" style="display: none;"
                            id="delete-form-' . $row->id . '"  >
                            <input type="hidden" name="_token" value="' . csrf_token() . '">
                            <input type="hidden" name="_method" value="DELETE">
                        </form>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);;
        }
        return view('admin.customers.list', compact('trainers'));

    }

    public function Contracts()
    {

        $contracts = Contract::with('customers')->orderBy('id', 'DESC')->get();
        return view('admin.contracts', compact('contracts'));
    }

    public function ViewContract($contract_id)
    {

        $contract = Contract::where('id', $contract_id)->first();
        return view('admin.contract_view', compact('contract'));
    }

    public function AddPayment(Request $request)
    {

        $payment = new Payment();
        $payment->customer_id = $request->customer_id;
        $payment->invoice = $request->invoice;
        $payment->customer_name = $request->customer_name;
        $payment->customer_email = $request->customer_email;
        $payment->payment = $request->payment;
        $payment->save();

        $get_user_id = Customer::where('id', $request->customer_id)->pluck('user_id')->first();

        $notification = new Notification();
        $notification->sender_id = Auth::user()->id;
        $notification->receiver_id = $get_user_id;
        $notification->notification = "Admin send you a payment request.";
        $notification->type = "Payment";
        $notification->save();

        return redirect()->back()->with('success', 'Payment sent successfully...!!!');
    }

    public function AdminassignTrainer(Request $request)
    {

        // dd($request->all());

        if ($request->customer_id != null) {

            $customer = Customer::whereIn('id', $request->customer_id)->get();
            // $customer_id = $request->customer_id;
            $trainer_id = $request->trainer_id;
            $trainer = Trainer::where('id', $trainer_id)->first();

            try {
                foreach ($customer as $value) {
                    if ($request->trainer_date != null) {
                        foreach ($request->trainer_date as $key => $trainer_date) {

                            $date = new DateTime($request->trainer_date[$key] . '' . $request->trainer_time[$key], new DateTimeZone($request->time_zone));
                            $date->setTimezone(new DateTimeZone('America/New_York'));
                            $sessionDate = $date->format('Y-m-d');
                            $sessionTime = $date->format('H:i:s');

                            // if($trainer->time_zone == "America/Washington") {

                            //     date_default_timezone_set('America/Los_Angeles');
                            //     $sess_time        = $request->trainer_date[$key].' '.$request->trainer_time[$key];
                            //     $datetime         = new DateTime($sess_time);
                            //     $trainer_timeZone = new DateTimeZone("America/Chicago");
                            //     $datetime->setTimezone($trainer_timeZone);
                            //     $trainer_timezone_date = $datetime->format('d-m-Y');
                            //     $trainer_timezone_date = $datetime->format('Y-m-d');
                            //     // add one extra hour in time
                            //     $train_time            = $datetime->format('H:i');
                            //     $timestamp             = strtotime($train_time) + 60*60; // 10:09 + 1 hour
                            //     $trainer_timezone_time =  date('H:i', $timestamp);

                            // } else {

                            //     date_default_timezone_set('America/Los_Angeles');
                            //     $sess_time = $request->trainer_date[$key].' '.$request->trainer_time[$key];
                            //     $datetime  = new DateTime($sess_time);

                            //     // echo $datetime->format('Y-m-d H:i:s') . "<br>";
                            //     $trainer_timeZone = new DateTimeZone($trainer->time_zone);

                            //     $datetime->setTimezone($trainer_timeZone);
                            //     // $trainer_timezone_date =  $datetime->format('d-m-Y');
                            //     // $trainer_timezone_time =  $datetime->format('H:i');
                            //     $trainer_timezone_date =  $datetime->format('Y-m-d');
                            //     $trainer_timezone_time =  $datetime->format('H:i');
                            // }

                            // if($value->time_zone == "America/Washington") {

                            //     $sesss_time            = $request->trainer_date[$key].' '.$request->trainer_time[$key];
                            //     $newdatetime           = new DateTime($sesss_time);
                            //     $customer_timeZone     = new DateTimeZone("America/Chicago");
                            //     $newdatetime->setTimezone($customer_timeZone);
                            //     $customer_timezone_date =  $newdatetime->format('Y-m-d');

                            //     // add one extra hour in time
                            //     $cust_time              = $datetime->format('H:i');
                            //     $cust_timestamp         = strtotime($cust_time) + 60*60; // 10:09 + 1 hour
                            //     $customer_timezone_time =  date('H:i', $cust_timestamp);

                            // } else {

                            //     $sesss_time            = $request->trainer_date[$key].' '.$request->trainer_time[$key];
                            //     $newdatetime           = new DateTime($sesss_time);
                            //     $customer_timeZone     = new DateTimeZone($value->time_zone);
                            //     $newdatetime->setTimezone($customer_timeZone);
                            //     $customer_timezone_date =  $newdatetime->format('Y-m-d');
                            //     $customer_timezone_time =  $newdatetime->format('H:i');
                            // }


                            $meeting_data = [
                                "topic" => $request->session_type,
                                "start_time" => $sessionDate . ' ' . $sessionTime,
                                "duration" => 180,
                                "agenda" => "Weekly Session",
                                "host_video" => "",
                                "participant_video" => "",
                                "time_zone" => 'America/New_York',
                            ];

                            $resp = $this->create($meeting_data);

                            $trainerDate = new DateTime($sessionDate . '' . $sessionTime, new DateTimeZone($resp['data']['timezone']));
                            $trainerDate->setTimezone(new DateTimeZone($trainer->time_zone));
                            $trainer_timezone_date = $trainerDate->format('Y-m-d');
                            $trainer_timezone_time = $trainerDate->format('H:i:s');

                            $customerDate = new DateTime($sessionDate . '' . $sessionTime, new DateTimeZone($resp['data']['timezone']));
                            $customerDate->setTimezone(new DateTimeZone($value->time_zone));
                            $customer_timezone_date = $customerDate->format('Y-m-d');
                            $customer_timezone_time = $customerDate->format('H:i:s');

                            // $mailData = array(

                            //     'first_name'   => $value->first_name,
                            //     'last_name'    => $value->last_name,
                            //     'email'        => $value->email,
                            //     'phone'        => $value->phone,
                            //     'session_date' => $request->trainer_date[$key],
                            //     'session_time' => $request->trainer_time[$key],
                            //     'to'           => $value["email"],
                            // );

                            // Mail::send('front.emails.session_request', $mailData, function($message) use($mailData){
                            //     $message->to($mailData['to'])->subject('Fitzen Studio - Session Request');
                            // });
                            $mailData_customer = array(
                                'to' => $value->email,
                                'name' => $value->first_name . ' ' . $value->last_name,
                                'trainer' => $trainer['name'],
                                'join_url' => $resp["data"]["join_url"],
                                "start_date" => date('d-m-Y', strtotime($customer_timezone_date)),
                                "start_time" => $customer_timezone_time,
                                // "pass_code"  => $resp["data"]["password"],
                            );

                            Mail::send('admin.emails.assigntrainer-customer', $mailData_customer, function ($message) use ($mailData_customer) {
                                $message->to($mailData_customer['to'])->subject('Fitzen Studio - Assign Trainer');
                            });

                            $mailData_trainer = array(
                                'to' => $trainer['email'],
                                'name' => $trainer['name'],
                                // 'customer'   => $customer['first_name'] . ' ' . $customer['last_name'],
                                'start_url' => $resp["data"]["start_url"],
                                "start_date" => date('d-m-Y', strtotime($trainer_timezone_date)),
                                "start_time" => $trainer_timezone_time,
                            );
                            Mail::send('admin.emails.assigntrainer-trainer', $mailData_trainer, function ($message) use ($mailData_trainer) {
                                $message->to($mailData_trainer['to'])->subject('Fitzen Studio - Assign Customer');
                            });


                            // $demo                             = new BookDemoSession();
                            // $demo->customer_id                = $value->id;
                            // $demo->first_name                 = $value->first_name;
                            // $demo->last_name                  = $value->last_name;
                            // $demo->email                      = $value->email;
                            // $demo->phone                      = $value->phone;
                            // $demo->session_date               = $request->trainer_date[$key];
                            // $demo->session_time               = $request->trainer_time[$key];
                            // $demo->status                     = "trainer_assigned";
                            // $demo->save();


                            $cust_to_trainer = new CustomerToTrainer();
                            $cust_to_trainer->start_url = $resp["data"]["start_url"];
                            $cust_to_trainer->join_url = $resp["data"]["join_url"];
                            $cust_to_trainer->meeting_id = $resp["data"]["id"];
                            $cust_to_trainer->customer_id = $value->id;
                            $cust_to_trainer->trainer_id = $trainer_id;
                            $cust_to_trainer->trainer_date = $request->trainer_date[$key];
                            $cust_to_trainer->trainer_time = $request->trainer_time[$key];
                            $cust_to_trainer->time_zone = $request->time_zone;
                            $cust_to_trainer->notes = $request->notes;
                            $cust_to_trainer->session_type = $request->session_type;
                            $cust_to_trainer->trainer_timezone_date = $trainer_timezone_date;
                            $cust_to_trainer->trainer_timezone_time = $trainer_timezone_time;
                            $cust_to_trainer->customer_timezone_date = $customer_timezone_date;
                            $cust_to_trainer->customer_timezone_time = $customer_timezone_time;

                            $cust_to_trainer->save();

                            $notify = "You have a new Session request by admin";

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
                }

                return redirect()->back()->with('success', 'Trainer Assigned Successfully.');

            } catch (\Exception $e) {

                return redirect()->back()->with('error', $e->getMessage());
            }
        }
    }

    public function Sessions()
    {
        $upcoming_sessions = CustomerToTrainer::with('customer', 'trainer', 'sessions', 'timeZone')->orderBy('id', 'DESC')->get();
        return view('admin.sessions', compact('upcoming_sessions'));
    }

    public function CancelSession(Request $request)
    {

        $session = CustomerToTrainer::find($request->customer_to_trainer_id);

        $resp = $this->delete($session->meeting_id);

        if ($resp['success']) {

            $session->status = "canceled";
            $session->save();

            return redirect()->back()->with('success', 'Session Cancelled Successfully..!!');

        } else {

            return redirect()->back()->with('error', 'Oops! Something went wrong. Session has not cancelled.');

        }
    }
}
