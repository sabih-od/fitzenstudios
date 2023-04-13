<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Customer;
use App\Traits\PHPCustomMail;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Models\Notification;
use App\Models\Lead;



class RegisterController extends Controller
{
    use RegistersUsers, PHPCustomMail;
    public function redirectTo()
    {
        return '/customer/dashboard';
    }
    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'f_name'   => ['required', 'string', 'max:255'],
            'l_name'   => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);
    }


    protected function create(array $data)
    {
        $check_user = User::where('email', $data['email'])->first();
        if($check_user == null) {
            $user =  User::create([
                'name'     => $data['f_name'] . ' ' . $data['l_name'],
                'email'    => $data['email'],
                'phone'    => $data['phone'],
                'role_id'  => '2',
                'password' => Hash::make($data['password']),
                'message'  => $data['message'],
            ]);

            Customer::create([
                'user_id'    => $user->id,
                'first_name' => $data['f_name'],//explode(' ', $user->name)[0],
                'last_name'  => $data['l_name'],//substr( $user->name, strpos( $user->name, " ") + 1),
                'email'      => $user->email,
                'phone'      => $user->phone,
                'timezone'  => $data["time_zone"],
                'time_zone'  => $data["time_zone"],
                "is_lead"    => 1,
            ]);
            Lead::create([
                'user_id'     => $user->id,
                'is_customer' => 0,
                'first_name'  => $data["f_name"],
                'last_name'   => $data["l_name"],
                'email'       => $user->email,
                'phone'       => $user->phone,
                'note'        =>  $data['message'],

            ]);

            $notification               = new Notification();
            $notification->sender_id    = $user->id;
            $notification->receiver_id  = 1;
            $notification->notification = $data["l_name"] . " is registered on your website as a customer.";
            $notification->type         = "New Customer Registration";
            $notification->save();

            $mailData = [
                'to' => $data['email'],
                'subject' => 'Fitzen Studio - Thank you for Signing Up',
                'view' => 'front.emails.thankyou-signup',
            ];
            Mail::send($mailData['view'], [], function($message) use($mailData){
                $message->to($mailData['to'])->subject($mailData['subject']);
            });

//            $view = view('front.emails.thankyou-signup')
//                ->with('to', $data['email'])
//                ->render();
//            $this->customphpmailer('noreply@fitzenstudios.com', $data['email'], 'Fitzen Studio - Thank you for Signing Up', $view);


            return $user;

        } else {
            return redirect()->back()->with('error', 'Email already exist. Please try another one..!!');
        }
    }

    public function CompleteRegistration(Request $request)
    {
        $user = "";
        if(isset($request->token)){
            $user = User::where('password',$request->token)->first();
        }

        return view('auth.complete-registration', compact('user'));
    }

    public function RegisterTrainer(Request $request)
    {
        $user = User::where('password',$request->verification_token)->first();
        if(isset($user))
        {
            $user->password = Hash::make($request->password);
            $user->save();
            $request->merge(['email' => $user->email]);
            $credentials = $request->only('email', 'password');

            if (auth()->attempt($credentials)) {
                return redirect('trainer/dashboard')->
                with('success','Registration Completed Successfully.');
            }

        }
        else{
            return redirect('complete-registration?token='.$request->verification_token)->
            with('success','Category Updated Successfully.');

        }
    }
}
