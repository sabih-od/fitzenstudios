<?php

namespace App\Http\Controllers\Admin;

use App\Mail\AdminAssignCustomer;
use App\Mail\AdminAssignTrainer;
use DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
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
use App\Models\Contract;
use App\Models\Payment;
use App\Models\Lead;
use App\Models\TimeZone;
use File;
use Auth;
use DateTime;
use DateTimeZone;
use Hash;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Validation\Rule;
use App\Traits\PHPCustomMail;

class AdminCustomerController extends Controller
{
    use ZoomMeetingTrait, PHPCustomMail;

    const MEETING_TYPE_INSTANT = 1;
    const MEETING_TYPE_SCHEDULE = 2;
    const MEETING_TYPE_RECURRING = 3;
    const MEETING_TYPE_FIXED_RECURRING_FIXED = 8;

    public function index(Request $request)
    {
        return view('admin.customers.index')->with('customers', Customer::where('is_lead', 0)->orderBy('id', 'DESC')->get());
    }

    public function customerRegistration(Request $request)
    {
        $request->validate(
            [
                'f_name' => 'required',
                'l_name' => 'required',
                'email' => 'required|unique:users,email',
                'time_zone' => 'required',
                'phone' => 'required'
            ],
            [
                'f_name.required' => 'The first name field is required.',
                'l_name.required' => 'At last name field is required.',
                'email.required' => 'The email field is required.',
                'email.unique' => 'This email is already taken. Choose another one then try again!',
                'time_zone.required' => 'The timezone field is required.',
                'phone.required' => 'The phone field is required.',
            ]
        );
        try {

            DB::beginTransaction();

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
                'first_name' => $request->f_name,
                'last_name' => $request->l_name,
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
                'pass' => $request->password,
                'from' => 'noreply@fitzenstudios.com'
            );

//            $view = view('front.emails.thankyou-signup-customer')
//                ->with('to', $request->email)
//                ->with('pass', $request->password)
//                ->render();
            //$this->customphpmailer('noreply@fitzenstudios.com', $mailData['to'], 'Fitzen Studio - Signing Up', $view);
            Mail::send('front.emails.thankyou-signup-customer', $mailData, function($message) use($mailData){
                $message->to($mailData['to'])
                    ->subject('Fitzen Studio - Signing Up')
                    ->from($mailData['to']);
            });

            DB::commit();
            return redirect()->back()->with('success', 'Customer is successfully created.');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function assignTrainer(Request $request)
    {
        $customer_id = $request->customer_id;
        $trainer_id = $request->trainer_id;
        $customer = Customer::with('timeZone')->where('id', $customer_id)->first();
        $trainer = Trainer::where('id', $trainer_id)->first();
        $exist = CustomerToTrainer::where('customer_id', $customer_id)->first();
        $timezone = TimeZone::find($request->time_zone);
        //dd($customer_id, $trainer_id, $customer, $trainer, $exist, $timezone);
        try {
            DB::beginTransaction();

            $trainerTime = date('h:i:s', strtotime($request->trainer_time));
            $date = new DateTime($request->trainer_date . '' . $trainerTime, new DateTimeZone($timezone->timezone_value));
            $date->setTimezone(new DateTimeZone($timezone->timezone_value));
            $sessionDate = $date->format('Y-m-d');
            $sessionTime = $date->format('H:i:s');
            $meeting_data = [
                "topic" => $request->session_type,
                "start_time" => $sessionDate . ' ' . $sessionTime,
                "duration" => 180,
                "agenda" => "demo session",
                "host_video" => "",
                "participant_video" => "",
                "time_zone" => $timezone->timezone_value
            ];
            //dd($meeting_data);
            $resp = $this->create($meeting_data);
            //dd($resp, $trainer, $customer);
            //dd($trainer->time_zone);

            $trainerDate = new DateTime($sessionDate . '' . $sessionTime, new DateTimeZone($resp['data']['timezone']));
            $trainerDate->setTimezone(new DateTimeZone($timezone->timezone_value));
            $trainer_timezone_date = $trainerDate->format('Y-m-d');
            $trainer_timezone_time = $trainerDate->format('H:i:s');

            $customerDate = new DateTime($sessionDate . '' . $sessionTime, new DateTimeZone($resp['data']['timezone']));
            $customerDate->setTimezone(new DateTimeZone($timezone->timezone_value));
            $customer_timezone_date = $customerDate->format('Y-m-d');
            $customer_timezone_time = $customerDate->format('H:i:s');
//            dd($trainerDate, $trainer_timezone_date, $trainer_timezone_time);
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
//            $mailData_customer = array(
//                'to' => $customer['email'],
//                'name' => $customer['first_name'] . ' ' . $customer['last_name'],
//                'trainer' => $trainer['name'],
//                'join_url' => $resp["data"]["join_url"],
//                // "start_date" => date('d-m-Y', strtotime($request->input('trainer_date'))),
//                // "start_time" => $request->input('trainer_time'),
//                "start_date" => $customer_timezone_date,
//                "start_time" => $customer_timezone_time
//            );
//            Mail::send('admin.emails.assigntrainer-customer', $mailData_customer, function ($message) use ($mailData_customer) {
//                $message->to($mailData_customer['to'])->subject('Fitzen Studio - Assign Trainer');
//            });


//            $mailData_trainer = array(
//                'to' => $trainer['email'],
//                'name' => $trainer['name'],
//                'customer' => $customer['first_name'] . ' ' . $customer['last_name'],
//                'start_url' => $resp["data"]["start_url"],
//                // "start_date" => date('d-m-Y', strtotime($request->input('trainer_date'))),
//                // "start_time" => $request->input('trainer_time'),
//                "start_date" => $trainer_timezone_date,
//                "start_time" => $trainer_timezone_time
//            );
//            Mail::send('admin.emails.assigntrainer-trainer', $mailData_trainer, function ($message) use ($mailData_trainer) {
//                $message->to($mailData_trainer['to'])->subject('Fitzen Studio - Assign Trainer');
//            });

            $assignTrainerCustomerHtml = view('admin.emails.assigntrainer-customer')
                ->with('to', $customer['email'])
                ->with('name', $customer['first_name'] . ' ' . $customer['last_name'])
                ->with('trainer', $trainer['name'])
                ->with('join_url', $resp["data"]["join_url"])
                ->with('start_date', $customer_timezone_date)
                ->with('start_time', $customer_timezone_time)
                ->render();
            $this->customphpmailer('noreply@fitzenstudios.com', $customer['email'], 'Fitzen Studio - Assign Trainer', $assignTrainerCustomerHtml);

//            $assignTrainerHtml = view('admin.emails.assigntrainer-trainer')
//                ->with('to', $trainer['email'])
//                ->with('name', $trainer['first_name'] . ' ' . $customer['last_name'])
//                ->with('customer', $customer['first_name'] . ' ' . $customer['last_name'])
//                ->with('start_url', $resp["data"]["start_url"])
//                ->with('start_date', $trainer_timezone_date)
//                ->with('start_time', $trainer_timezone_time)
//                ->render();
//            $this->customphpmailer('noreply@fitzenstudios.com', $customer['email'], 'Fitzen Studio - Assign Trainer', $assignTrainerHtml);

            $assignTrainerData = [
                'to' => $trainer['email'],
                'subject' => 'Fitzen Studio - Assign Trainer',
                'view' => 'admin.emails.assigntrainer-trainer',
                'data' => [
                    'name' => $trainer['first_name'] . ' ' . $trainer['last_name'],
                    'customer' => $customer['first_name'] . ' ' . $customer['last_name'],
                    'start_url' => $resp["data"]["start_url"],
                    'start_date' => $trainer_timezone_date,
                    'start_time' => $trainer_timezone_time,
                ],
            ];
            Mail::send($assignTrainerData['view'], $assignTrainerData['data'], function($message) use($assignTrainerData){
                $message->to($assignTrainerData['to'])
                    ->subject($assignTrainerData['subject']);
            });


            if ($exist != null) {
                CustomerToTrainer::where('customer_id', $customer_id)->update([
                    'start_url' => $resp["data"]["start_url"],
                    'join_url' => $resp["data"]["join_url"],
                    'meeting_id' => $resp["data"]["id"],
                    'trainer_id' => $trainer_id,
                    'trainer_date' => $request->trainer_date,
                    'trainer_time' => $trainerTime,
                    'notes' => $request->notes,
                    'session_type' => $request->session_type,
                    'trainer_timezone_date' => $trainer_timezone_date,
                    'trainer_timezone_time' => $trainer_timezone_time,
                    'customer_timezone_date' => $customer_timezone_date,
                    'customer_timezone_time' => $customer_timezone_time,
                    'time_zone' => $timezone->id
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
                    'time_zone' => $timezone->id
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
            DB::commit();
            return redirect()->route('admin.sessions')->with('success', 'Trainer assigned successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage() . " Line: " . $e->getLine());
        }

    }

    public function Performance(Request $request)
    {

        $upcoming_sessions = CustomerToTrainer::with('customer', 'trainer')->orderBy('id', 'Desc')->get();
        return view('admin.performance', compact('upcoming_sessions'));
    }

    public function RescheduleRequests()
    {
        $all_requests = RescheduleRequest::with('sessions','timeZone')->orderBy('id', 'DESC')->where('status', 'pending')->get();
        return view('admin.rescheduled_requests', compact('all_requests'));
    }

    public function DeleteRescheduleRequest(Request $request)
    {
        $delete_row = RescheduleRequest::where('id', $request->id)->delete();
        return redirect('admin/reschedule-requests')->with('success', 'Request Deleted Successfully..!!');
    }

    public function ApproveRequest($reschedule_id)
    {
        try {
            DB::beginTransaction();

            $reschedule_request = RescheduleRequest::find($reschedule_id);
            $session = CustomerToTrainer::find($reschedule_request->customer_to_trainer_id);

            if(empty($session)) {
                DB::commit();
                RescheduleRequest::find($reschedule_id)->delete();
                return redirect()->back()->with('error', 'The session was not exits anymore therefore, the request is deleted.');
            }

            $timezone = TimeZone::find($session->time_zone);
            $date = new DateTime($reschedule_request->new_session_date . '' . $reschedule_request->new_session_time, new DateTimeZone($timezone->timezone_value));
            $date->setTimezone(new DateTimeZone($timezone->timezone_value));
            $sessionDate = $date->format('Y-m-d');
            $sessionTime = $date->format('H:i:s');
            $data = [
                "topic" => $session->session_type,
                "start_time" => $sessionDate . ' ' . $sessionTime,
                "duration" => 60,
                "agenda" => $reschedule_request->reason,
                "host_video" => " ",
                "participant_video" => " ",
                "time_zone" => $timezone->timezone_value
            ];

            $resp = $this->update($session->meeting_id, $data);
            if ($resp['success']) {
                $customer_id = $session->customer_id;
                $trainer_id = $session->trainer_id;
                $customer = Customer::where('id', $customer_id)->first();
                $trainer = Trainer::where('id', $trainer_id)->first();

                $customerDateTime = new DateTime($sessionDate . '' . $sessionTime, new DateTimeZone($timezone->timezone_value));
                $customerDateTime->setTimezone(new DateTimeZone($timezone->timezone_value));
                $customerDate = $customerDateTime->format('Y-m-d');
                $customerTime = $customerDateTime->format('H:i:s');

                $trainerDateTime = new DateTime($sessionDate . '' . $sessionTime, new DateTimeZone($timezone->timezone_value));
                $trainerDateTime->setTimezone(new DateTimeZone($timezone->timezone_value));
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

//                $mailData_customer = array(
//                    'to' => $customer['email'],
//                    'name' => $customer['first_name'] . ' ' . $customer['last_name'],
//                    'trainer' => $trainer['name'],
//                    'join_url' => $update_session->join_url,
//                    "start_date" => date('d-m-Y', strtotime($customerDate)),
//                    "start_time" => $customerTime
//                );
//                Mail::send('admin.emails.assigntrainer-customer', $mailData_customer, function ($message) use ($mailData_customer) {
//                    $message->to($mailData_customer['to'])->subject('Fitzen Studio - Assign Trainer');
//                });

//                $mailData_trainer = array(
//                    'to' => $trainer['email'],
//                    'name' => $trainer['name'],
//                    'customer' => $customer['first_name'] . ' ' . $customer['last_name'],
//                    'start_url' => $update_session->start_url,
//                    "start_date" => date('d-m-Y', strtotime($trainerDate)),
//                    "start_time" => $trainerTime
//                );
//                Mail::send('admin.emails.assigntrainer-trainer', $mailData_trainer, function ($message) use ($mailData_trainer) {
//                    $message->to($mailData_trainer['to'])->subject('Fitzen Studio - Assign Trainer');
//                });

                $assignTrainerData = [
                    'to' => $customer['email'],
                    'subject' => 'Fitzen Studio - Assign Trainer',
                    'view' => 'admin.emails.assigntrainer-customer',
                    'data' => [
                        'name' => $customer['first_name'] . ' ' . $customer['last_name'],
                        'trainer' => $trainer['name'],
                        'join_url' => $update_session->join_url,
                        'start_date' => date('d-m-Y', strtotime($customerDate)),
                        'start_time' => $customerTime,
                    ],
                ];

                Mail::send($assignTrainerData['view'], $assignTrainerData['data'], function($message) use($assignTrainerData){
                    $message->to($assignTrainerData['to'])
                        ->subject($assignTrainerData['subject']);
                });
//                $subject = 'Fitzen Studio - Assign Trainer';
//                $assignTrainerCustomerTemplate = view('admin.emails.assigntrainer-customer')
//                    ->with('to', $customer['email'])
//                    ->with('name', $customer['first_name'] . ' ' . $customer['last_name'])
//                    ->with('trainer', $trainer['name'])
//                    ->with('join_url', $update_session->join_url)
//                    ->with('start_date', date('d-m-Y', strtotime($customerDate)))
//                    ->with('start_time', $customerTime)
//                    ->render();
//                $this->customphpmailer('noreply@fitzenstudios.com', $customer['email'], $subject, $assignTrainerCustomerTemplate);

//                $assignTrainerTemplate = view('admin.emails.assigntrainer-trainer')
//                    ->with('to', $trainer['email'])
//                    ->with('name', $trainer['first_name'] . ' ' . $customer['last_name'])
//                    ->with('customer', $customer['first_name'] . ' ' . $customer['last_name'])
//                    ->with('start_url', $update_session->start_url)
//                    ->with('start_date', date('d-m-Y', strtotime($trainerDate)))
//                    ->with('start_time', $trainerTime)
//                    ->render();
//                $this->customphpmailer('noreply@fitzenstudios.com', $customer['email'], $subject, $assignTrainerTemplate);
                $assignTrainerData = [
                    'to' => $trainer['email'],
                    'subject' => 'Fitzen Studio - Assign Trainer',
                    'view' => 'admin.emails.assigntrainer-trainer',
                    'data' => [
                        'name' => $trainer['first_name'] . ' ' . $customer['last_name'],
                        'customer' => $customer['first_name'] . ' ' . $customer['last_name'],
                        'start_url' => $update_session->start_url,
                        'start_date' => date('d-m-Y', strtotime($trainerDate)),
                        'start_time' => $trainerTime,
                    ],
                ];

                Mail::send($assignTrainerData['view'], $assignTrainerData['data'], function($message) use($assignTrainerData){
                    $message->to($assignTrainerData['to'])
                        ->subject($assignTrainerData['subject']);
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
                DB::commit();
                return redirect('admin/reschedule-requests')->with('success', 'Re-Scheduled Request approved successfully...!!');
            } else {
                return redirect()->back()->with('error', 'Oops! Something went wrong.');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function UpdateSessionStatus(Request $request)
    {
        try {
            $update = CustomerToTrainer::find($request->session_id);
            $update->status = $request->status;
            $update->save();
            return redirect()->back()->with('success', 'Session Status Updated successfully.');
        } catch (\Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function PerformanceDetail($id)
    {
        return view('admin.performance_detail')
            ->with('detail', Performance::with('customer')->where('session_id', $id)->first());
    }

    public function CustomerDetail($customer_id)
    {
        return view('admin.customer_detail')
            ->with('detail', Customer::find($customer_id))
            ->with('cust_detail', CustomerDetail::where('customer_id', $customer_id)->first())
            ->with('schedules', CustomerToTrainer::with('customer', 'trainer')->where('customer_id', $customer_id)->get())
            ->with('performances', Performance::with('trainer', 'session')->where('customer_id', $customer_id)->get())
            ->with('payments', Payment::where('customer_id', $customer_id)->orderBy('id', 'DESC')->get());
    }

    public function destroy($id, Request $request)
    {
        try {
            DB::beginTransaction();
            $customer = Customer::find($id);
            CustomerToTrainer::where('customer_id', $id)->delete();
            BookDemoSession::where('customer_id', $id)->delete();

            $user_id = $customer->user_id;
            User::where('id', $user_id)->delete();
            Lead::where('user_id', $user_id)->delete();

            $customer->delete();
            DB::commit();
            return redirect()->back()->with('success', 'Customer is successfully deleted.');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function profile($id)
    {
        return view('admin.customers.profile')->with('customer', Customer::find($id));
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
                ->make(true);
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
        return view('admin.contract_view')->with('contract', Contract::where('id', $contract_id)->first());
    }

    public function AddPayment(Request $request)
    {
        try {
            DB::beginTransaction();

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

            DB::commit();
            return redirect()->back()->with('success', 'Payment sent successfully.');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function adminAssignTrainer(Request $request)
    {
        $request->validate(
            [
            'trainer_id' => ['required', Rule::exists('trainers', 'id')],
            'customer_id' => ['required', 'array', function ($attr, $value, $fail) {
                if (!$value || !is_array($value)) {
                    return;
                }
            }],
            'session_type' => 'required',
            'trainer_date.*' => 'required',
            'trainer_time.*' => 'required',
            'time_zone' => ['required', Rule::exists('time_zones', 'id')],
            ],
            [
                'trainer_id.required' => 'The trainer field is required.',
                'customer_id.required' => 'At least one customer is required.',
                'session_type.required' => 'The session type field is required.',
                'time_zone.required' => 'The timezone field is required.',
                'trainer_date.*.required' => 'The session date field is required.',
                'trainer_time.*.required' => 'The session time field is required.',
            ]
        );

        try {
            DB::beginTransaction();

            $trainer_id = $request->trainer_id;
            $trainer = Trainer::where('id', $trainer_id)->first();
            $customer = Customer::whereIn('id', $request->customer_id)->get();
            foreach ($customer as $value) {
                foreach ($request->trainer_date as $key => $trainer_date) {
                    $timezone = TimeZone::find($request->time_zone);
                    $date = new DateTime($request->trainer_date[$key] . '' . $request->trainer_time[$key], new DateTimeZone($timezone->timezone_value));
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
                    $cust_to_trainer->trainer_time = $request->trainer_time[$key];
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
            return redirect()->back()->with('success', 'Trainer Assigned Successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function Sessions()
    {
        return view('admin.sessions')
            ->with('upcoming_sessions', CustomerToTrainer::with('customer', 'trainer', 'sessions', 'timeZone')->orderBy('id', 'DESC')->get());
    }

    public function CancelSession(Request $request)
    {
        $session = CustomerToTrainer::find($request->customer_to_trainer_id);
        $resp = $this->delete($session->meeting_id);

        if (!$resp['success']) {
            return redirect()->back()->with('error', 'Oops! Something went wrong. Session has not cancelled.');
        }

        $session->status = "canceled";
        $session->save();

        return redirect()->back()->with('success', 'Session Cancelled Successfully..!!');
    }
}
