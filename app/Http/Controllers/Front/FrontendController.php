<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\HomepageCMS;
use App\Models\AboutUsCMS;
use App\Models\PrivacyPolicyCMS;
use App\Models\FAQCMS;
use App\Models\ContactCMS;
use App\Models\ContactInquiry;
use App\Models\BookDemoSession;
use App\Models\DemoSessionCMS;
use App\Models\Newsletter;
use App\Models\TermsCMS;
use Illuminate\Support\Facades\Auth;
use App\Models\Customer;
use App\Models\CustomerToTrainer;
use App\Models\RescheduleRequest;
use App\Models\Notification;
use App\Models\FaqBannerCMS;
use App\Models\LoginCms;
use App\Models\SignupCms;
use App\Models\Trainer;
use Carbon;
use File;
class FrontendController extends Controller
{
    public function index() {
//        dd(bcrypt('admin!@#'));
//        dd(\Hash::make('admin!@#'));

        $content = HomepageCMS::find(1);
        return view('front.index',compact('content'));
    }
    public function BookDemo() {
        $content = DemoSessionCMS::find(1);
        return view('front.bookdemo',compact('content'));
    }
    public function AboutUs() {
        $content = AboutUsCMS::find(1);
        return view('front.about',compact('content'));
    }
    public function FAQS() {
        $faqs    = FAQCMS::all();
        $content = FaqBannerCMS::find(1);
        return view('front.faqs',compact('faqs', 'content'));
    }
    public function ContactUs() {
        $content = ContactCMS::find(1);
        return view('front.contactus', compact('content'));
    }
    public function PrivacyPolicy() {
        $content = PrivacyPolicyCMS::find(1);
        return view('front.privacypolicy',compact('content'));
    }
    public function TermsAndConditions() {
        $content = TermsCMS::find(1);
        return view('front.terms',compact('content'));
    }
    public function ContactFormSubmit(Request $request) {

        $inquiry             = new ContactInquiry();
        $inquiry->first_name = $request->first_name;
        $inquiry->last_name  = $request->last_name;
        $inquiry->email      = $request->email;
        $inquiry->phone      = $request->phone;
        $inquiry->message    = $request->message;
        $inquiry->save();

        $name     = $request->first_name.' '.$request->last_name;
        $mailData = array(
            'name'        => $name,
            'email'       => $request->email,
            'userMessage' => $request->message,
            'phone'       => $request->phone,
            // 'to'          => $setting->email,
            'to'          => "info@fitzen.studio",
        );

        Mail::send('front.emails.contact-us', $mailData, function($message) use($mailData){
            $message->to($mailData['to'])->subject('Fitzen Studio - Contact Us');
        });

        return redirect()->back()->with('message','Your Inquiry Submitted successfull. we will contact you shortly!');
    }
    public function SubmitDemoRequest(Request $request) {

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
                $demo->session_time = $request->session_time;
                $demo->goals        = $request->goals;
                $demo->message      = $request->message;
                $demo->customer_id  = $customer->id;
                $demo->save();
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
                return redirect()->back()->with('message','Welcome you onboard! We will get back to you shortly.');
            } catch (\Exception $e) {
                return redirect()->back()->with('error',$e->getMessage());
            }

        } else {
            return redirect()->back()->with('error', 'You already submitted request for demo session..!!');
        }





    }

    public function editDemoRequest(Request $request) {

        $customer = Customer::where('user_id', Auth()->id())->first();

        $demo               = BookDemoSession::find($request->demo_id);
        $demo->session_date = $request->session_date;
        $demo->session_time = $request->session_time;
        $demo->goals        = $request->goals;
        $demo->message      = $request->message;
        $demo->customer_id  = $customer->id;
        $demo->update();

        $mailData = array(
            'session_date' => $request->session_date,
            'session_time' => $request->session_time,
            'goals'        => $request->goals,
            'user_message' => $request->message,
            'to'           => "info@fitzen.studio",
        );

        Mail::send('front.emails.session_request', $mailData, function($message) use($mailData){
            $message->to($mailData['to'])->subject('Fitzen Studio - Session Request Updated');
        });

        return redirect()->back()->with('success','Demo session schedule updated');
    }

    public function RescheduleRequest(Request $request) {


        $check = RescheduleRequest::where('customer_to_trainer_id', $request->session_id)->first();
        $session = CustomerToTrainer::where('id', $request->session_id)->first();

        if ($request->request_by == "customer") {
            $timezone = Customer::select('time_zone')->where('id', $session->customer_id)->first();
        } else {
            $timezone = Trainer::select('time_zone')->where('id', $session->trainer_id)->first();
        }

        if ( $check == null) {

            $session_request                         = new RescheduleRequest();
            $session_request->customer_to_trainer_id = $request->session_id;
            $session_request->request_by             = $request->request_by;
            $session_request->new_session_date       = $request->new_session_date;
            $session_request->new_session_time       = $request->new_session_time;
            $session_request->time_zone              = $timezone->time_zone;
            $session_request->reason                 = $request->reason;
            $session_request->save();

            $notification               = new Notification();
            $notification->sender_id    = Auth::user()->id;
            $notification->receiver_id  = 1;
            $notification->notification = "Demo Request is Re-Scheduled by ".$request->request_by;
            $notification->type         = "ReSchedule Session";
            $notification->save();


            if($request->request_by == "customer") {

                return redirect('customer/dashboard')->with('success', 'Request Added successfully');
            } else {
                return redirect('trainer/dashboard')->with('success', 'Request Added successfully');

            }


        } else {

            $session_request                         = RescheduleRequest::find($check->id);
            $session_request->customer_to_trainer_id = $request->session_id;
            $session_request->request_by             = $request->request_by;
            $session_request->new_session_date       = $request->new_session_date;
            $session_request->new_session_time       = $request->new_session_time;
            $session_request->time_zone              = $timezone->time_zone;
            $session_request->reason                 = $request->reason;
            $session_request->save();

            if($request->request_by == "customer") {

                return redirect('customer/dashboard')->with('success', 'Request Added successfully');
            } else {
                return redirect('trainer/dashboard')->with('success', 'Request Added successfully');

            }

        }



    }

    public function subscribeNewsletter(Request $request) {

        try{

            if($request->method() == 'POST'){

                $email = $request->email;
                $json  = array('status' => false);
                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $json['error'] = "Error: Invalid email format";
                }

                if( $email == null || $email == ''){
                    $json['error'] = "Error: Please type correct email address";
                }

                $alreadyExists = Newsletter::where('email', $email)->first();
                if($alreadyExists != null){
                    $json['error'] = "Error: You have already subscribed";
                }

                if(!isset($json['error'])){
                    $letter        = new Newsletter();
                    $letter->email = $email;
                    $letter->save();

                    $mailData = array(
                        'email'        => $request->email,
                        'to'           => "info@fitzen.studio",
                    );

                    Mail::send('front.emails.newsletter', $mailData, function($message) use($mailData){
                        $message->to($mailData['to'])->subject('Fitzen Studio - Newsletter');
                    });

                    $notification               = new Notification();
                    $notification->sender_id    = 1;
                    $notification->receiver_id  = 1;
                    $notification->notification = $email." is subscribed for newsletter on your website";
                    $notification->type         = "NewsLetter";
                    $notification->save();

                    $json['status']  = true;
                    $json["success"] =  "Success: You Have Successfully Subscribed";
                }


                return $json;
            }
        }catch (\Exception $ex){


            $json           = array();
            $json['status'] = false;
            $json['error']  = "Whoops!! Something went wrong ";
            return $json;
        }

    }

    public function ThankYouForRegistration(){
        return view('front.thank-you-registration');
    }

    public function LoginCMS() {
        $content = LoginCms::find(1);
       return view('admin.cms.logincms', compact('content'));
    }

    public function SignupCMS() {
        $content = SignupCms::find(1);
       return view('admin.cms.signupcms', compact('content'));
    }


    public function UpdateLoginCMS(Request $request) {

        $dirPath = "uploads/images/login";

        $content              = LoginCms::find(1);
        $content->banner_text = $request->banner_text;
        if($request->hasFile('banner_image'))
        {
            if(File::exists(public_path($dirPath.'/'.$request->banner_image))){
                File::delete(public_path($dirPath.'/'.$request->banner_image));
            }
            $fileName = time().'-'.$request->banner_image->getClientOriginalName();
            $request->banner_image->move(public_path($dirPath), $fileName);

            $content->banner_image =  $dirPath.'/'.$fileName;
        }
        $content->save();

        return redirect()->back()->with('success','Data Updated Successfully....!!!');
    }

    public function UpdateSignupCMS(Request $request) {

        $dirPath = "uploads/images/signup";

        $content              = SignupCms::find(1);
        $content->banner_text = $request->banner_text;
        if($request->hasFile('banner_image'))
        {
            if(File::exists(public_path($dirPath.'/'.$request->banner_image))){
                File::delete(public_path($dirPath.'/'.$request->banner_image));
            }
            $fileName = time().'-'.$request->banner_image->getClientOriginalName();
            $request->banner_image->move(public_path($dirPath), $fileName);

            $content->banner_image =  $dirPath.'/'.$fileName;
        }
        $content->save();

        return redirect()->back()->with('success','Data Updated Successfully....!!!');
    }

    //
}
