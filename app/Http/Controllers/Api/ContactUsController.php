<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\FAQCMS;
use App\Traits\PHPCustomMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Models\ContactInquiry;

class ContactUsController extends Controller
{
    use PHPCustomMail;


    public function contactUs(Request $request)
    {

        $validate = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'message' => 'required',
        ]);

        if ($validate->fails()) {
            return response()->json(['validate_error' => $validate->messages()]);
        } else {
            $name = $request->first_name . ' ' . $request->last_name;
            $mailData = [
                'name' => $name,
                'email' => $request->email,
                'userMessage' => $request->message,
                'phone' => $request->phone,
                'from' => "info@fitzen.studio",
                'to' => $request->email,

            ];

             $contactinquiry = new ContactInquiry();
             $contactinquiry->first_name = $request->first_name;
             $contactinquiry->last_name = $request->last_name;
             $contactinquiry->phone = $request->phone;
             $contactinquiry->email = $request->email;
             $contactinquiry->message = $request->message;
             $contactinquiry->save();
            try {
                Mail::send('front.emails.contact-us', $mailData, function ($message) use ($mailData) {
                    $message->to($mailData['to'])->subject('Fitzen Studio - Contact Us');
                });
            } catch (\Exception $e) {
                return response()->json([
                    'status' => 500,
                    'message' => 'An error occurred while sending the email. Please try again later.',
                    'error' => $e->getMessage(),
                ]);
            }
        }

        return response()->json([
            'status' => 200,
            'message' => 'Your inquiry has been submitted successfully. We will contact you shortly!',
        ]);
    }


    public function fAQs()
    {
        $faqs = FAQCMS::all();
        return response()->json(['status' => 200, 'faqs' => $faqs,]);
    }

}
