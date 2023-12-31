<?php

use App\Http\Controllers\Api\SessionController;
use App\Http\Controllers\Api\TrainerController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ContactUsController;
use App\Http\Controllers\Api\CustomerReportController;

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
//    Route::post('/register',[UserController::class,'register']);
//
//    Route::post('/get/trainers',[TrainerController::class,'getTrainer']);

});


Route::middleware('auth:sanctum')->group(function () {
    // Protected routes here

    Route::get('me', [UserController::class,'me']);
    Route::post('/change-password',[UserController::class,'changePassword']);

    Route::post('/customer-report',[CustomerReportController::class,'customerReport']);
    Route::post('/contact-us',[ContactUsController::class,'contactUs']);
    Route::get('/faqs',[ContactUsController::class,'fAQs']);

    Route::get('sessions', [SessionController::class,'index']);
    Route::post('create-session', [SessionController::class,'createSession']);
    Route::post('cancel-session', [SessionController::class, 'CancelSession']);
    Route::post('book-demo-session',[SessionController::class,'bookDemoSession']);

    Route::post('reschedule-session', [SessionController::class,'reschedule']);
    Route::post('join-zoom-meeting', [SessionController::class,'joinZoomMeeting']);

    Route::post('/profile-update',[UserController::class,'profileUpdate']);
    Route::post('/profile',[UserController::class,'getProfile']);

    Route::get('/get-time-zones',[SessionController::class,'getTimeZones']);
    Route::get('/get-my-notifications',[\App\Http\Controllers\NotificationController::class,'getMyNotifications']);


    Route::get('/trainers',[TrainerController::class,'getTrainers']);
    Route::get('/training-type',[TrainerController::class,'getTrainingType']);
    Route::post('/add-training-type',[TrainerController::class,'addTrainingType']);
});


