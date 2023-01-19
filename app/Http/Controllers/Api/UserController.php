<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Customer;
use App\Models\CustomerDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function login(Request $request){    

        if ($request->user_email == "") {
            return response()->json(["status" => 0, "message" => 'Email Required'], 400);
        }
        if ($request->user_pass == "") {
            return response()->json(["status" => 0, "message" => 'Password Required'], 400);
        }

        $user = User::where('email','=',$request->user_email)->first();

        if($user !== null){

            $check =  Hash::check($request->user_pass, $user->password);

            if($check){
                return response()->json(['status' => 1, 'message' => 'login successfully', 'step' => $user->profile_status, 'user_detail' => $user], 200);
            }else{
                return response()->json(['status' => 0, 'message' => 'Incorrect User Name Or Password'], 200);
            }
        }else{
            return response()->json(['status' => 0, 'message' => 'login Fail'], 404);
        }
    }

    public function register(Request $request){

    
        if ($request->email == "") {
            return response()->json(["status" => 0, "message" => 'Email Required'], 400);
        }
        if ($request->password == "") {
            return response()->json(["status" => 0, "message" => 'Password Required'], 400);
        }

        $uniqueEmail = User::where('email','=',$request->email)->first();

        if($uniqueEmail){
            return response()->json(["status" => 0, "message" => 'Email Already Exist'], 400);
        }


        $user = new User;
        $user->role_id = 2;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->profile_status = 'SIGN_UP';
        $user->save();

        $customer = new Customer;
        $customer->user_id =  $user->id;
        $customer->email = $request->email;        
        $customer->type = 'new';
        $customer->save();

        return response([
            'status' => true,
            'profile_status' => 'SIGN_UP',
            'user_id' => $user->id
        ]);
    }

    public function profileUpdate(Request $request){

        $user = User::where('id','=',$request->user_id)->first();
        
        if($user  == null){
            return response()->json(['status' => 0, 'message' => 'User Not Found'], 404);
        }
        if($request->step == "STEP_ONE"){
            $this->stepOne($request,$user->id);
            $user->profile_status = "STEP_ONE";
            $user->save();
        }elseif($request->step == "STEP_TWO"){
            $this->stepTwo($request,$user->id);
            $user->profile_status = "STEP_TWO";
            $user->save();
        }elseif($request->step == "STEP_THREE"){
            $user->profile_status = "STEP_THREE";
            $this->stepThree($request,$user->id);
            $user->save();
        }elseif($request->step == "STEP_FOUR"){
            $this->stepFour($request,$user->id);
            $user->profile_status = "STEP_FOUR";
            $user->save();
        }

        return response()->json(['status' => 1, 'message' => 'Profile Updated','step' =>  $user->profile_status, 'user_id' => $user->id], 200);
    }


    private function stepOne($request,$user_id){


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

        $customers = Customer::where('user_id',$user_id)->first();
        $customers->first_name =  $request->first_name;
        $customers->last_name = $request->last_name;
        $customers->phone = $request->phone;
        $customers->dob    = $request->dob;
        $customers->gender = $request->gender;
        $customers->weight    = $request->weight;
        $customers->residence = $request->residence;
        $customers->age = $request->age;
        $customers->nationality = $request->nationality;
        $customers->city = $request->city;
        $customers->timezone  = $request->timezone;
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

    private function stepTwo($request,$user_id){

        if ($request->life_style == "") {
            return response()->json(["status" => 0, "message" => 'Life style Required'], 400);
        }
        if ($request->workout_experience == "") {
            return response()->json(["status" => 0, "message" => 'Workout Experience Required'], 400);
        }
        if ($request->period == "") {
            return response()->json(["status" => 0, "message" => 'Period Required'], 400);
        }
        $customers = Customer::where('user_id',$user_id)->first();        

        $customers = CustomerDetail::where('customer_id',$customers->id)->first();
        $customers->life_style  =  $request->life_style;
        $customers->workout_experience = $request->workout_experience;
        $customers->period = $request->period;
        $customers->save();
        return true;
    }

    private function stepThree($request,$user_id){

        if ($request->injuries == "") {
            return response()->json(["status" => 0, "message" => 'Injuries Required'], 400);
        }
        if ($request->workout_type == "") {
            return response()->json(["status" => 0, "message" => 'Workout Type Required'], 400);
        }
        if ($request->focus_of_workout == "") {
            return response()->json(["status" => 0, "message" => 'Focus of workout Required'], 400);
        }
        $customers = Customer::where('user_id',$user_id)->first();     

        $customers = CustomerDetail::where('customer_id',$customers->id)->first();
        $customers->injuries = $request->injuries;
        $customers->workout_type = $request->workout_type;
        $customers->focus_of_workout = $request->focus_of_workout;
        $customers->save();
        return true;
    }

    private function stepFour($request,$user_id){

        if ($request->med_conditions == "") {
            return response()->json(["status" => 0, "message" => 'Medical conditions Required'], 400);
        }
        if ($request->on_medication == "") {
            return response()->json(["status" => 0, "message" => 'On medication Required'], 400);
        }
        if ($request->sleep == "") {
            return response()->json(["status" => 0, "message" => 'Sleep Required'], 400);
        }
        $customers = Customer::where('user_id',$user_id)->first();  

        $customers = CustomerDetail::where('customer_id',$customers->id)->first();
        $customers->med_conditions = $request->med_conditions;
        $customers->on_medication = $request->on_medication;
        $customers->sleep = $request->sleep;
        $customers->save();
        return true;
    }
}
