<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FAQCMS;
use App\Traits\PHPCustomMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
class ContactUsController extends Controller
{
    use PHPCustomMail;
       public  function contactUs(Request $request){
           $validate = Validator::make($request->all(),[
               'first_name'=>'required',
               'last_name'=>'required',
               'phone'=>'required',
               'email'=>'required',
               'message'=>'required',
           ]);

           if($validate->fails()){
               return response()->json(['validate_error'=>$validate->messages(),]);

           }else{
               $name     = $request->first_name.' '.$request->last_name;
               $mailData = array(
                   'name'        => $name,
                   'email'       => $request->email,
                   'userMessage' => $request->message,
                   'phone'       => $request->phone,
                   'to'          => "info@fitzen.studio",
               );
               Mail::send('front.emails.contact-us', $mailData, function($message) use($mailData){
                   $message->to($mailData['to'])->subject('Fitzen Studio - Contact Us');
               });
           }
           return response()->json(['status'=> 200, 'message'=>'Your inquiry has been submitted successfully. We will contact you shortly!']);
       }



         public function fAQs(){
         $faqs = FAQCMS::all();
        return response()->json(['status'=> 200, 'faqs'=>$faqs,]);
    }

}
