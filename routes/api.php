<?php

use App\Http\Controllers\Api\SessionController;
use App\Http\Controllers\Api\TrainerController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

//Route::middleware(['auth:api'])->group(function () {
Route::middleware([])->group(function () {
    Route::post('/login',[UserController::class,'login']);
    Route::post('/register',[UserController::class,'register']);
//    Route::post('/profile-update',[UserController::class,'profileUpdate']);
//    Route::post('/register',[UserController::class,'register']);
//
//    Route::post('/get/trainers',[TrainerController::class,'getTrainer']);
});

Route::middleware('auth:sanctum')->group(function () {
    // Protected routes here
    Route::get('me', [UserController::class,'me']);
    Route::get('sessions', [SessionController::class,'index']);
    Route::post('reschedule-session', [SessionController::class,'reschedule']);
});


