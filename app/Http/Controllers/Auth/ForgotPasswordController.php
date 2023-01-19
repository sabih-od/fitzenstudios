<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

use App\Models\User;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function index()
    {
        return view('auth.passwords.email');
    }

    public function forgotPassword(Request $request){
        if ($request->method() == 'POST'){
            $validator = Validator::make($request->all(), [
                'email' =>  'required|email'
            ]);
            if ($validator->fails()){
                return redirect()->back()->withErrors($validator->errors())->withInput();
            }

            $email = $request->input('email');
            $token = $request->input('_token');

            $user = User::where('email', $email)->first();
            if ($user == null || empty($user)){
                return redirect()->back()->withErrors(['email' =>'Your email is not matched'])->withInput();
            }

            $user->remember_token = $token;
            $user->save();

            $url = $request->root().'/create_new_password?token='.$token.'&id='.$user->id;
            //dd($url);
            $mailData = array(
                'email' => $email,
                'url'  => $url,
            );
            Mail::send('front.email.reset_password', $mailData, function($message) use($mailData){
                $message->to($mailData['email'])
                    ->subject('Password Reset - Fitzen');
            });


            return redirect()->back()->with(['success' => 'Success! We have sent you an email']);

        }
       // return view('auth.forgot-password');
    }

    public function showUpdatePassword(){
        return view('auth.passwords.create_password');
    }

    public function resetPassword(Request $request){
        $id = $request->get('id');
        $token = $request->get('token');

        if ($request->method() == 'POST'){
            $validator = Validator::make($request->all(), [
                'password' =>  'required|min:8|confirmed',
                //'confirm_new_password' => 'required|confirmed'
            ]);
            if ($validator->fails()){
                return redirect()->back()->withErrors($validator->errors())->withInput();
            }
            $token = $request->input('_token');
            $id = $request->input('id');

            $user = User::where('remember_token', $token)->where('id', $id)->first();
            if ($user != null){
                $user->password = Hash::make($request->input('password'));
                if ($user->save()) {
                    return redirect('/login')->with('success', '<strong>Success! </strong> Password Updated Successfully.')->withInput();
                }else{
                    return redirect()->back()->with(['error' => '<strong>Error! </strong> Something Went Wrong'])->withInput();
                }
            }else{
                return redirect()->back()->with(['error' => '<strong>Error! </strong> Something Went Wrong'])->withInput();
            }
        }else{
            $user = User::where('id', $id)->where('remember_token', $token)->first();
            $userError = null;
            if ($user == null){
                $userError = "Invalid User";
            }
            return view('auth.pass', compact('userError', 'user'));
        }
    }
}
