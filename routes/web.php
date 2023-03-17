<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ManufacturerController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductImageController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\HomePageCMSController;
use App\Http\Controllers\Front\FrontendController;
use App\Http\Controllers\Admin\AboutUsCMSController;
use App\Http\Controllers\Admin\PrivacyPolicyCMSController;
use App\Http\Controllers\Admin\TermsAndConditionCMSController;
use App\Http\Controllers\Admin\FAQCMSController;
use App\Http\Controllers\Admin\ContactCMSController;
use App\Http\Controllers\Admin\FooterCMSController;
use App\Http\Controllers\Admin\HeaderCMSController;
use App\Http\Controllers\Admin\BookDemoSessionController;
use App\Http\Controllers\Customer\CustomerController;
use App\Http\Controllers\Admin\TrainerController;
use App\Http\Controllers\Admin\AdminCustomerController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Trainer\TrainerPortalController;
use App\Http\Controllers\Admin\ZoomMeetingController;
use App\Http\Controllers\Admin\LeadsController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SignaturePadController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;


Route::get('signaturepad', [SignaturePadController::class, 'index']);
Route::post('signaturepad', [SignaturePadController::class, 'upload'])->name('signaturepad.upload');


Route::get('/',[FrontendController::class,'index'])->name('home');
Route::get('about-us',[FrontendController::class,'AboutUs'])->name('about');
Route::get('faqs',[FrontendController::class,'FAQS'])->name('faqs');
Route::get('contact-us',[FrontendController::class,'ContactUs'])->name('contactus');
Route::get('privacy-policy',[FrontendController::class,'PrivacyPolicy']);
Route::get('terms-and-conditions',[FrontendController::class,'TermsAndConditions']);
Route::post('contact-submit',[FrontendController::class,'ContactFormSubmit']);
Route::post('/news-letter', [FrontendController::class,'subscribeNewsletter'])->name('newsletter');
Route::get('thankyou-for-registration',[FrontendController::class,'ThankYouForRegistration']);
Route::get('complete-registration',[RegisterController::class,'CompleteRegistration'])->name('complete-registration');
Route::post('RegisterTrainer',[RegisterController::class,'RegisterTrainer'])->name('RegisterTrainer');
Route::post('reschedule-request',[FrontendController::class,'RescheduleRequest']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/admin/login', [AdminController::class,'login']);
Route::prefix('admin')->middleware('auth')->group(function () {

    Route::post('customer-register', [AdminCustomerController::class, 'customerRegistration']);
    Route::resource('/leads', LeadsController::class);
    Route::resource('/categories', CategoryController::class);
    Route::resource('homepage',HomePageCMSController::class);
    Route::resource('aboutus',AboutUsCMSController::class);
    Route::resource('privacypolicy',PrivacyPolicyCMSController::class);
    Route::resource('terms',TermsAndConditionCMSController::class);
    Route::resource('faq',FAQCMSController::class);

    Route::get('login-cms',[FrontendController::class,'LoginCMS']);
    Route::post('update-login-cms',[FrontendController::class,'UpdateLoginCMS']);
    Route::get('signup-cms',[FrontendController::class,'SignupCMS']);
    Route::post('update-signup-cms',[FrontendController::class,'UpdateSignupCMS']);

    Route::post('updateBannerFaq',[FAQCMSController::class,'updateBannerFaq']);
    Route::resource('contact',ContactCMSController::class);
    Route::resource('footercms',FooterCMSController::class);
    Route::resource('headercms',HeaderCMSController::class);
    Route::resource('demosessioncms',BookDemoSessionController::class);
    Route::resource('meetings',ZoomMeetingController::class);

    Route::get('create-session',[AdminController::class, "CreateSession"])->name('CreateSession');
    Route::get('demo-session/{id}',[AdminController::class, "DemoSession"]);
    Route::get('permanent-customer/{id}',[AdminController::class, "PermanentCustomer"]);

    Route::get('contact-inquiry',[ContactCMSController::class, "ContactInquiry"]);
    Route::post('delete-contact-inquiry',[ContactCMSController::class, "DeleteContactInquiry"]);
    Route::get('session-request',[ContactCMSController::class, "SessionRequest"]);
    Route::post('delete-session-request',[ContactCMSController::class, "DeleteSessionRequest"]);
    Route::get('newsletter',[ContactCMSController::class, "NewsLetter"]);
    Route::post('delete-newsletter',[ContactCMSController::class,'DeleteNewsletter']);
    Route::resource('/manufacturers', ManufacturerController::class);
    Route::get('/manufacturers/GetManufacturers/{id}', [ManufacturerController::class, 'GetManufacturers'])->name('GetManufacturers');
    Route::resource('/products',ProductController::class);
    Route::get('/product_images/{id}', [ProductImageController::class, 'index'])->name('index');
    Route::post('/product_images/store', [ProductImageController::class, 'store'])->name('store');
    Route::post('/product_images/additional_images', [ProductImageController::class, 'additional_images'])->name('additional_images');
    Route::post('/product_images/deleteProdImage', [ProductImageController::class, 'deleteProdImage'])->name('deleteProdImage');
    Route::get('change-password',[AdminController::class, 'ChangePassword']);
    Route::post('change-password',[AdminController::class, 'ChangePassword'])->name('change.password');
    Route::get('dashboard',[AdminController::class, 'dashboard']);

    // Trainer
    Route::get('/trainers',[TrainerController::class, 'index'])->name('trainer.index');
    Route::get('/edit-trainer/{id}',[TrainerController::class, 'EditTrainer']);
    Route::post('/updateTrainer',[TrainerController::class, 'UpdateTrainer']);
    Route::post('/add-trainer-payment',[TrainerController::class, 'AddTrainerPayment'])->name('add_trainer_payment');



    Route::post('/trainer/create',[TrainerController::class, 'store'])->name('trainer.create');
    Route::delete('/trainer/delete/{id}',[TrainerController::class, 'destroy'])->name('trainer.destroy');

    // Customer
    Route::get('/customers',[AdminCustomerController::class, 'index'])->name('customer.index');
    Route::post('/customer/create',[AdminCustomerController::class, 'store'])->name('customer.create');
    Route::post('/customer/assign/trainer',[AdminCustomerController::class, 'assignTrainer'])->name('customer.assignTrainer');
    Route::post('/admin-assign-trainer',[AdminCustomerController::class, 'adminAssignTrainer'])->name('admin.adminAssignTrainer');

    Route::delete('/customer/delete/{id}',[AdminCustomerController::class, 'destroy'])->name('customer.destroy');
    Route::get('/customer-profile/{id}',[AdminCustomerController::class, 'profile'])->name('profile');
    Route::get('/customer-schedule',[AdminCustomerController::class, 'Schedule'])->name('Schedule');
    Route::get('/performance',[AdminCustomerController::class, 'Performance'])->name('performance');
    Route::post('update-session-status',[AdminCustomerController::class,'UpdateSessionStatus'])->name('update-session-status');
    Route::get('performance-detail/{id}',[AdminCustomerController::class,'PerformanceDetail'])->name('performance-detail');
    Route::get('reschedule-requests',[AdminCustomerController::class,'RescheduleRequests'])->name('reschedule-requests');
    Route::post('delete-schedule-request',[AdminCustomerController::class,'DeleteRescheduleRequest']);
    Route::post('approve-request/{id}',[AdminCustomerController::class,'ApproveRequest']);
    Route::get('customer-detail/{id}',[AdminCustomerController::class,'CustomerDetail'])->name('customer-detail');
    Route::get('contracts', [AdminCustomerController::class, 'Contracts']);
    Route::get('view-contract/{id}', [AdminCustomerController::class, 'ViewContract']);
    Route::post('add-payment', [AdminCustomerController::class, 'AddPayment']);

    Route::get('sessions',[AdminCustomerController::class, 'Sessions'])->name('sessions');
    Route::post('cancel-session', [AdminCustomerController::class, 'CancelSession']);


    Route::get('get-notification', function(){
        return view('admin.notification');
    })->name('admin.notification');


});

Route::get('getting-notifications',[NotificationController::class,'getNotification'])->middleware('auth')->name('getNotification');

Route::middleware('auth')->group(function () {

    Route::get('book-demo',[FrontendController::class,'BookDemo']);
    Route::post('submit-demo',[FrontendController::class,'SubmitDemoRequest']);
    Route::put('edit-demo',[FrontendController::class,'editDemoRequest'])->name('editDemoRequest');

});

Route::prefix('customer')->middleware('auth')->group(function () {

    Route::get('dashboard',[CustomerController::class, 'dashboard']);
    Route::post('calendardatafetch',[CustomerController::class, 'customersitecalendardatafetch'])->name('customer-site-calendar-data-fetch');

    Route::get('profile',[CustomerController::class, 'profile']);
    Route::get('contract',[CustomerController::class, 'Contract']);
    Route::post('submit-contract',[CustomerController::class, 'SubmitContract']);
    Route::get('performance-detail/{id}',[CustomerController::class,'PerformanceDetail'])->name('performance-detail');
    Route::get('profile-edit',[CustomerController::class, 'ProfileEdit']);
    Route::get('payments',[CustomerController::class, 'Payments'])->name('payments');
    Route::post('payment',[CustomerController::class, 'Payment'])->name('payment');
    Route::get('sessions',[CustomerController::class, 'Sessions'])->name('sessions');
    Route::post('add-review',[CustomerController::class, 'AddReview'])->name('add-review');
    Route::post('cancel-session', [CustomerController::class, 'CancelSession']);
    Route::post('ProfileUpdate',[CustomerController::class, 'ProfileUpdate'])->name('ProfileUpdate');
    Route::get('get-notification', function(){
        return view('customer.notification');
    })->name('customer.notification');

});

Route::prefix('trainer')->middleware('auth')->group(function () {
    Route::get('customer-details',[TrainerPortalController::class, 'CustomerDetails'])->name('cust_details');

    Route::get('dashboard',[TrainerPortalController::class, 'dashboard']);
    Route::post('calendardatafetch',[TrainerPortalController::class, 'calendardatafetch'])->name('calendardatafetch');

    Route::get('payments',[TrainerPortalController::class, 'Payments']);

    Route::get('profile/{id}',[TrainerPortalController::class, 'EditProfile']);
    Route::post('ProfileUpdate',[TrainerPortalController::class, 'ProfileUpdate'])->name('ProfileUpdate');
    Route::get('join-meeting/{id}',[TrainerPortalController::class,'JoinMeeting']);
    Route::get('add-customer-details/{id}',[TrainerPortalController::class,'AddCustomerDetails'])->name('add_details');
    Route::post('update_customer_details',[TrainerPortalController::class,'UpdateCustomerDetails']);
    Route::get('performance',[TrainerPortalController::class,'Performance'])->name('performance');
    Route::post('update-session-status',[TrainerPortalController::class,'UpdateSessionStatus'])->name('update-session-status');
    Route::get('add-customer-performance/{id}',[TrainerPortalController::class,'AddCustomerPerformance'])->name('add-customer-performance');
    Route::get('performance-detail/{id}',[TrainerPortalController::class,'PerformanceDetail'])->name('performance-detail');
    Route::post('add-performance',[TrainerPortalController::class,'AddPerformance'])->name('add-performance');
    Route::get('get-notification', function(){
        return view('trainer.notification');
    })->name('trainer.notification');
    Route::get('sessions',[TrainerPortalController::class, 'Sessions'])->name('sessions');
    Route::post('cancel-session', [TrainerPortalController::class, 'CancelSession']);

});


Route::get('forgot_password', [ForgotPasswordController::class, 'index'])->name('forgot_password');
Route::post('forgot-password', [ForgotPasswordController::class, 'forgotPassword'])->name('forgot.password.get');
Route::get('create_new_password', [ForgotPasswordController::class, 'showUpdatePassword'])->name('create_new_password');
Route::post('update-password', [ForgotPasswordController::class, 'resetPassword'])->name('update.password');
