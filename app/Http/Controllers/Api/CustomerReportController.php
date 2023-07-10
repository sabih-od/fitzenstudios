<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\CustomerReport;

class CustomerReportController extends Controller
{
    public function customerReport(Request $request){

        $validate = Validator::make($request->all(),[
            'generic_time_loging_in'=>'required',
            'generic_time_loging_out'=>'required',
            'generic_pre_workout_meal'=>'required',
            'generic_hours_sleep_prev_day'=>'required',
            'generic_count_prev_day'=>'required',
            'generic_count_during_session'=>'required',
            'generic_pains_mindful'=>'required',
            'mobility_time_taken'=>'required',
            'mobility_difficulty_notice'=>'required',
            'core_reps_workout'=>'required',
            'core_number_laps'=>'required',
            'core_count_prev_day'=>'required',
            'core_difficulty_notice'=>'required',
            'core_comments'=>'required',
            'speed_agility_reps_workout'=>'required',
            'speed_agility_number_laps'=>'required',
            'speed_agility_count_prev_day'=>'required',
            'speed_agility_difficulty_notice'=>'required',
            'speed_agility_comments'=>'required',
            'speed_reps_workout'=>'required',
            'speed_number_laps'=>'required',
            'speed_count_prev_day'=>'required',
            'speed_difficulty_notice'=>'required',
            'speed_comments'=>'required',
            'denomination'=>'required',
            'kind_weights'=>'required',
            'porps'=>'required',
            'comments'=>'required',
            'cool_time_taken'=>'required',
            'cool_difficulty_notice'=>'required',
        ]);
        if($validate->fails()){
            return response()->json(['validate_error'=>$validate->messages(),]);

        }else{

            $customer_report = new CustomerReport();
            $customer_report->customer_id = Auth::user()->id;
            $customer_report->generic_time_loging_in = $request->generic_time_loging_in;
            $customer_report->generic_time_loging_out = $request->generic_time_loging_out;
            $customer_report->generic_pre_workout_meal = $request->generic_pre_workout_meal;
            $customer_report->generic_hours_sleep_prev_day = $request->generic_hours_sleep_prev_day;
            $customer_report->generic_count_prev_day = $request->generic_count_prev_day;
            $customer_report->generic_activity_done_prev_day = $request->generic_activity_done_prev_day;
            $customer_report->generic_count_during_session = $request->generic_count_during_session;
            $customer_report->generic_pains_mindful = $request->generic_pains_mindful;
            $customer_report->generic_mood_energy_level = $request->generic_mood_energy_level;
            $customer_report->generic_average_during_session = $request->generic_average_during_session;

            $customer_report->mobility_time_taken = $request->mobility_time_taken;
            $customer_report->mobility_difficulty_notice = $request->mobility_difficulty_notice;

            $customer_report->core_reps_workout = $request->core_reps_workout;
            $customer_report->core_number_laps = $request->core_number_laps;
            $customer_report->core_count_prev_day = $request->core_count_prev_day;
            $customer_report->core_difficulty_notice = $request->core_difficulty_notice;
            $customer_report->core_comments = $request->core_comments;

            $customer_report->speed_agility_reps_workout = $request->speed_agility_reps_workout;
            $customer_report->speed_agility_number_laps = $request->speed_agility_number_laps;
            $customer_report->speed_agility_count_prev_day = $request->speed_agility_count_prev_day;
            $customer_report->speed_agility_difficulty_notice = $request->speed_agility_difficulty_notice;
            $customer_report->speed_agility_comments = $request->speed_agility_comments;

            $customer_report->speed_reps_workout = $request->speed_reps_workout;
            $customer_report->speed_number_laps = $request->speed_number_laps;
            $customer_report->speed_count_prev_day = $request->speed_count_prev_day;
            $customer_report->speed_difficulty_notice = $request->speed_difficulty_notice;
            $customer_report->speed_comments = $request->speed_comments;

            $customer_report->denomination = $request->denomination;
            $customer_report->kind_weights = $request->kind_weights;
            $customer_report->porps = $request->porps;
            $customer_report->comments = $request->comments;
            $customer_report->cool_time_taken = $request->cool_time_taken;
            $customer_report->cool_difficulty_notice = $request->cool_difficulty_notice;
            $customer_report->save();

             if($customer_report){
                 return response()->json(['status'=> 200, 'message'=>'Customer Report Add Successfully',]);

             }else{
                 return response()->json(['error'=> 404, 'message'=>'Customer Report Not Add',]);

             }
        }

    }
}
