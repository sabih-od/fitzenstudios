<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Models\Notification;
use App\Models\TimeZone;
use App\Models\User;
use App\Models\Customer;
use App\Models\CustomerDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->getMessageBag());
        }

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $token = Auth::user()->createToken('authToken')->plainTextToken;
            return response()->json(['token' => $token], 200);
        }

        return response()->json(['message' => 'Unauthorized'], 401);
    }

    public function me(Request $request)
    {
        return response()->json(Auth::user());
    }

    public function register(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'first_name' => 'nullable',
            'last_name' => 'nullable',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:4',
            'phone' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->getMessageBag());
        }

        try {
            DB::beginTransaction();
            $user = User::create([
                'name' => isset($request->first_name) ? $request->first_name : $request->email,
                'email' => $request->email,
                'phone' => $request->phone,
                'role_id' => '2',
                'password' => Hash::make($request->password),
                'message' => $request->message,
            ]);

            $timezone = TimeZone::where('timezone_value', $request->time_zone)->first();

            Customer::create([
                'user_id' => $user->id,
                'first_name' => isset($request->first_name) ? $request->first_name : $request->email,//explode(' ', $user->name)[0],
                'last_name' => isset($request->last_name) ? $request->last_name : $request->email,//substr( $user->name, strpos( $user->name, " ") + 1),
                'email' => $user->email,
                'phone' => $user->phone,
                'timezone' => $timezone->id ?? null,
                'time_zone' => $timezone->id ?? null,
                "is_lead" => 1,
            ]);
            Lead::create([
                'user_id' => $user->id,
                'is_customer' => 0,
                'first_name' => isset($request->first_name) ? $request->first_name : $request->email,
                'last_name' => isset($request->last_name) ? $request->last_name : $request->email,
                'email' => $user->email,
                'phone' => $user->phone,
                'note' => $request->message,

            ]);

            $notification = new Notification();
            $notification->sender_id = $user->id;
            $notification->receiver_id = 1;
            $notification->notification = $request->last_name . " is registered on your website as a customer.";
            $notification->type = "New Customer Registration";
            $notification->save();

            $mailData = [
                'to' => $request->email,
                'subject' => 'Fitzen Studio - Thank you for Signing Up',
                'view' => 'front.emails.thankyou-signup',
            ];

            try {
                Mail::send($mailData['view'], [], function ($message) use ($mailData) {
                    $message->to($mailData['to'])->subject($mailData['subject']);
                });
            } catch (\Exception $e) {
                Log::error('register: mail not sent registering ' . $user->name . '. Error: ' . $e->getMessage());
            }

            DB::commit();

            Auth::login($user);
            $token = Auth::user()->createToken('authToken')->plainTextToken;
            return response()->json(['token' => $token], 200);
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json($exception->getMessage());
        }
    }

    public function profileUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->getMessageBag());
        }
        $user = User::where('id', '=', $request->user_id)->first();

        if(!$user){
            return response()->json(['status' => 1, 'message' => 'User Not Found' , 'data' => []], 404);
        }


        $customers = Customer::where('user_id', $request->user_id)->first();

        if(!$customers){
            return response()->json(['status' => 1, 'message' => 'Customer Not Found' , 'data' => []], 404);

        }

        $customers->first_name = $request->first_name;
        $customers->last_name = $request->last_name;
        $customers->phone = $request->phone;
        $customers->dob = $request->dob;
        $customers->gender = $request->gender;
        $customers->weight = $request->weight;
        $customers->residence = $request->residence;
        $customers->age = $request->age;
        $customers->nationality = $request->nationality;
        $customers->city = $request->city;
        $customers->timezone = $request->timezone;
        $customers->days = $request->days;
        $customers->sessions_in_week = $request->sessions_in_week;
        $customers->training_type = $request->training_type;
        $customers->tariner_id = $request->trainer_id;
        $customers->is_lead = 1;
        $customers->save();

        if ($request->has('password')) {
            $validator = Validator::make($request->all(), [
                'current_password' => 'required',
                'new_password' => 'required',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->getMessageBag());
            }

            if (!Hash::check($request->current_password, $user->password)) {
                return response()->json([
                    'message' => 'The current password is incorrect.'
                ]);
            }

            $user->password = Hash::make($request->new_password);
            $user->save();
        }


        return response()->json([
            'success' => true,
            'message' => 'Profile updated successfully!',
        ]);

    }

    public function getProfile (Request $request)
    {
        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->getMessageBag());
        }

        $customers = Customer::where('user_id', $request->user_id)->first();

        if(!$customers){
            return response()->json(['status' => 1, 'message' => 'Customer Not Found' , 'data' => []], 404);

        }


        return response()->json([
            'first_name' => $customers->first_name,
            'last_name' => $customers->last_name,
            'phone' => $customers->phone,
            'dob' => $customers->dob,
            'gender' => $customers->gender,
            'weight' => $customers->weight,
            'residence' => $customers->residence,
            'age' => $customers->age,
            'nationality' => $customers->nationality,
            'city' => $customers->city,
            'timezone' => $customers->timezone,
            'days' => $customers->days,
            'sessions_in_week' => $customers->sessions_in_week,
            'training_type' => $customers->training_type,
            'trainer_id' => $customers->tariner_id,
        ]);
    }


    private function stepOne($request, $user_id)
    {


        if ($request->first_name == "") {
            return response()->json(["status" => 0, "message" => 'First name Required'], 400);
        }
        if ($request->last_name == "") {
            return response()->json(["status" => 0, "message" => 'Last name Required'], 400);
        }
        if ($request->dob == "") {
            return response()->json(["status" => 0, "message" => 'Date of birth name Required'], 400);
        }
        if ($request->gender == "") {
            return response()->json(["status" => 0, "message" => 'Gender Required'], 400);
        }
        if ($request->weight == "") {
            return response()->json(["status" => 0, "message" => 'Weight Required'], 400);
        }
        if ($request->residence == "") {
            return response()->json(["status" => 0, "message" => 'residence Required'], 400);
        }
        if ($request->nationality == "") {
            return response()->json(["status" => 0, "message" => 'nationality Required'], 400);
        }
        if ($request->city == "") {
            return response()->json(["status" => 0, "message" => 'city Required'], 400);
        }
        if ($request->timezone == "") {
            return response()->json(["status" => 0, "message" => 'timezone Required'], 400);
        }
        if ($request->days == "") {
            return response()->json(["status" => 0, "message" => 'days Required'], 400);
        }
        if ($request->sessions_in_week == "") {
            return response()->json(["status" => 0, "message" => 'sessions in week Required'], 400);
        }
        if ($request->training_type == "") {
            return response()->json(["status" => 0, "message" => 'Training type Required'], 400);
        }
        if ($request->training_type == "") {
            return response()->json(["status" => 0, "message" => 'Training type Required'], 400);
        }

        $customers = Customer::where('user_id', $user_id)->first();
        $customers->first_name = $request->first_name;
        $customers->last_name = $request->last_name;
        $customers->phone = $request->phone;
        $customers->dob = $request->dob;
        $customers->gender = $request->gender;
        $customers->weight = $request->weight;
        $customers->residence = $request->residence;
        $customers->age = $request->age;
        $customers->nationality = $request->nationality;
        $customers->city = $request->city;
        $customers->timezone = $request->timezone;
        $customers->days = $request->days;
        $customers->sessions_in_week = $request->sessions_in_week;
        $customers->training_type = $request->training_type;
        $customers->tariner_id = $request->tariner_id;
        $customers->is_lead = 1;
        $customers->save();

        $customerDetail = new CustomerDetail;
        $customerDetail->customer_name = $customers->first_name;
        $customerDetail->customer_id = $customers->id;
        $customerDetail->save();
        return true;
    }

    private function stepTwo($request, $user_id)
    {

        if ($request->life_style == "") {
            return response()->json(["status" => 0, "message" => 'Life style Required'], 400);
        }
        if ($request->workout_experience == "") {
            return response()->json(["status" => 0, "message" => 'Workout Experience Required'], 400);
        }
        if ($request->period == "") {
            return response()->json(["status" => 0, "message" => 'Period Required'], 400);
        }
        $customers = Customer::where('user_id', $user_id)->first();

        $customers = CustomerDetail::where('customer_id', $customers->id)->first();
        $customers->life_style = $request->life_style;
        $customers->workout_experience = $request->workout_experience;
        $customers->period = $request->period;
        $customers->save();
        return true;
    }

    private function stepThree($request, $user_id)
    {

        if ($request->injuries == "") {
            return response()->json(["status" => 0, "message" => 'Injuries Required'], 400);
        }
        if ($request->workout_type == "") {
            return response()->json(["status" => 0, "message" => 'Workout Type Required'], 400);
        }
        if ($request->focus_of_workout == "") {
            return response()->json(["status" => 0, "message" => 'Focus of workout Required'], 400);
        }
        $customers = Customer::where('user_id', $user_id)->first();

        $customers = CustomerDetail::where('customer_id', $customers->id)->first();
        $customers->injuries = $request->injuries;
        $customers->workout_type = $request->workout_type;
        $customers->focus_of_workout = $request->focus_of_workout;
        $customers->save();
        return true;
    }

    private function stepFour($request, $user_id)
    {

        if ($request->med_conditions == "") {
            return response()->json(["status" => 0, "message" => 'Medical conditions Required'], 400);
        }
        if ($request->on_medication == "") {
            return response()->json(["status" => 0, "message" => 'On medication Required'], 400);
        }
        if ($request->sleep == "") {
            return response()->json(["status" => 0, "message" => 'Sleep Required'], 400);
        }
        $customers = Customer::where('user_id', $user_id)->first();

        $customers = CustomerDetail::where('customer_id', $customers->id)->first();
        $customers->med_conditions = $request->med_conditions;
        $customers->on_medication = $request->on_medication;
        $customers->sleep = $request->sleep;
        $customers->save();
        return true;
    }

    public  function changePassword(Request $request){

        $user = Auth::user();

        $validator = Validator::make($request->all(), [
            'current_password' => 'required',
            'new_password' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json($validator->getMessageBag());
        }

        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'message' => 'The current password is incorrect.'
            ]);
        }

        $user->password = Hash::make($request->new_password);
        $user->save();

        return response()->json([
            'data' => "200",
            'message' => 'Password changed successfully'
        ]);

    }

}
