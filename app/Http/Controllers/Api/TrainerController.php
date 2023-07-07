<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Trainer;
use App\Models\TrainingType;
use App\Models\TraningType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TrainerController extends Controller
{
    public static function getTrainer(Request $request)
    {

        $trainerModel = Trainer::select('id', 'user_id', 'name')->get();

        if ($trainerModel) {
            return response([
                'status' => 1,
                'data' => $trainerModel
            ], 200);
        } else {
            return response([
                'status' => 0,
                'data' => []
            ], 200);
        }
    }

    public static function getTrainers(Request $request)
    {
        $trainers = Trainer::all();

        if ($trainers) {
            return response([
                'status' => 1,
                'data' => $trainers
            ], 200);
        } else {
            return response([
                'status' => 0,
                'data' => []
            ], 200);
        }
    }

    public static function getTrainingType(Request $request)
    {
        $types = TrainingType::all();

        if ($types) {
            return response([
                'status' => 1,
                'data' => $types
            ], 200);
        } else {
            return response([
                'status' => 1,
                'message' => 'No training types',
                'data' => [],
            ], 200);
        }
    }

    public static function addTrainingType(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'training_type' => 'required',
        ]);

        $data = $request->all();

        if ($validator->fails()) {
            return response()->json($validator->getMessageBag());
        }

        $types = new TrainingType([
            'training_type' => $data['training_type'],
        ]);

        $types->save();

        if ($types) {
            return response([
                'status' => 1,
                'message' => "Training Type Created Successfully",
                'data' => $types
            ], 200);
        } else {
            return response([
                'status' => 1,
                'message' => 'No training types',
                'data' => [],
            ], 200);
        }
    }

}
