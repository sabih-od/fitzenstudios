<?php

namespace App\Http\Controllers\Admin;

use DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Models\Trainer;
use App\Models\User;
use App\Models\CustomerToTrainer;
use App\Models\PaymentToTrainer;
use App\Models\Notification;

use Illuminate\Support\Facades\Mail;
use App\Models\Review;
use File;
use Auth;

class TrainerController extends Controller
{
    public function index(Request $request)
    {   
        $trainers = Trainer::orderBy('id','DESC')->get();
        return view('admin.trainers.list', compact('trainers'));
    }
   
    public function store(Request $request)
    {
        $check_email = User::where('email', $request->email)->first();
        if($check_email == null)
        {
            try {
                //code...
                $request->request->remove('_token');
                $request->request->remove('id');
    
                $user =  User::create([
                    'name'     => $request->name,
                    'email'    => $request->email,
                    'password' => Hash::make($request->email),           
                    'role_id'  => '3',        
                ]);
    
                Trainer::create([
                    'name'      => $request->name,
                    'email'     => $request->email, 
                    'user_id'   => $user->id,
                    'time_zone' => $request->time_zone,
                ]);
    
                $mailData = array(            
                    'to'   => $request->email,
                    'token'=> $user->password
                );         
        
                Mail::send('trainer.emails.invitation', $mailData, function($message) use($mailData){
                    $message->to($mailData['to'])->subject('Fitzen Studio - Invitation to join as trainer');
                });
                $msg = "Trainer Created Successfully. An invitation link sent to trianer to join.";
                return redirect()->back()->with('success',$msg);

            } catch (\Exception $e) {
                return redirect()->back()->with('error',$e->getMessage());
            }

        } else {

            // $trainer = Trainer::find($request->id);
            // $trainer->update($request->all());  
            return redirect()->back()->with('error','Email ALready Exist..!!');
        }
    }

    public function EditTrainer($id) {
        
        $trainer   = Trainer::find($id);
        $schedules = CustomerToTrainer::with('customer', 'trainer')->where('trainer_id', $id)->get();
        $rating    = Review::where('trainer_id', $id)->avg('rating');

        return view('admin.trainers.edit_trainer', compact('trainer', 'schedules', 'rating'));
    }

    public function UpdateTrainer(Request $request) {

        $dirPath = "uploads/images/home";


        $update_trainer                        = Trainer::find($request->trainer_id);
        $update_trainer->name                  = $request->name;
        $update_trainer->last_name             = $request->last_name;
        $update_trainer->phone                 = $request->phone;
        $update_trainer->gender                = $request->gender;
        $update_trainer->dob                   = $request->dob;
        $update_trainer->age                   = $request->age;
        $update_trainer->weight                = $request->weight;
        $update_trainer->nationality           = $request->nationality;
        $update_trainer->country               = $request->country;
        $update_trainer->city                  = $request->city;
        if($request->days_available) {
            $update_trainer->days_available    = json_encode($request->days_available);
        }
        $update_trainer->no_of_session_in_week = $request->no_of_session_in_week;
        $update_trainer->description           = $request->description;
        $update_trainer->time_zone             = $request->time_zone;


        if($request->hasFile('photo'))
        {
            if(File::exists(public_path($dirPath.'/'.$request->photo))){
                File::delete(public_path($dirPath.'/'.$request->photo));
            }    
            $fileName = time().'-'.$request->photo->getClientOriginalName();
            $request->photo->move(public_path($dirPath), $fileName);

            $update_trainer->photo =  $dirPath.'/'.$fileName;
        }
        $update_trainer->save();
        return redirect()->back()->with('success','Trainer Updated Successfully.');
    }

   
    public function destroy($id, Request $request)
    {   
        $trainer = Trainer::find($id);
        User::where('id', $trainer->user_id)->delete();
        $trainer->delete();  
        return redirect()->back()->with('success','Trainer Deleted Successfully.');
    }

    public function AddTrainerPayment(Request $request) {
        $dirPath = "uploads/images/about";
        $payment             = new PaymentToTrainer();
        $payment->trainer_id = $request->trainer_id;
        if($request->hasFile('slip'))
        {
            if(File::exists(public_path($dirPath.'/'.$request->slip))){
                File::delete(public_path($dirPath.'/'.$request->slip));
            }    
            $fileName = time().'-'.$request->slip->getClientOriginalName();
            $request->slip->move(public_path($dirPath), $fileName);

            $payment->slip =  $dirPath.'/'.$fileName;
        }
        $payment->save();

        $notification_to_trainer               = new Notification();
        $notification_to_trainer->sender_id    = Auth::user()->id; 
        $notification_to_trainer->receiver_id  = $request->trainer_id; 
        $notification_to_trainer->notification = "You have a new payment slip from admin"; 
        $notification_to_trainer->type         = "Payment Slip"; 
        $notification_to_trainer->save();

        return redirect()->back()->with('success', 'Payment slip added successfully...!!');
    }

    
}
