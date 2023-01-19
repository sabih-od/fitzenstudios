<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Trainer;
use Illuminate\Http\Request;

class TrainerController extends Controller
{
    public static function getTrainer(Request $request){

        $trainerModel = Trainer::select('id','user_id','name')->get();

        if($trainerModel){
            return response([
                'status' => 1,
                'data' => $trainerModel 
            ],200);
        }else{
            return response([
                'status' => 0,
                'data' => [] 
            ],200);
        }
    }
}
