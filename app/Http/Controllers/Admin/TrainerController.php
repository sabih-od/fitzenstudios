<?php

namespace App\Http\Controllers\Admin;

use App\Models\TimeZone;
use App\Traits\PHPCustomMail;
use DataTables;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Trainer;
use App\Models\User;
use App\Models\CustomerToTrainer;
use App\Models\PaymentToTrainer;
use App\Models\Notification;
use App\Models\Review;
use File;
use Auth;
use Illuminate\Support\Facades\Mail;

class TrainerController extends Controller
{
    use PHPCustomMail;

    public function index(Request $request)
    {
        return view('admin.trainers.list')
            ->with('trainers', Trainer::orderBy('id', 'DESC')->get())
            ->with('timezones', TimeZone::all());
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required|unique:users,email',
                'time_zone' => 'required',
            ],
            [
                'name.required' => 'The name field is required.',
                'email.required' => 'The email field is required.',
                'email.unique' => 'This email is already taken. Choose another one then try again!',
                'time_zone.required' => 'The timezone field is required.'
            ]
        );
        try {
            DB::beginTransaction();
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->email),
                'role_id' => '3',
            ]);

            Trainer::create([
                'name' => $request->name,
                'email' => $request->email,
                'user_id' => $user->id,
                'time_zone' => $request->time_zone,
            ]);

//            $view = view('trainer.emails.invitation')
//                ->with('to', $request->email)
//                ->with('token', $user->password)
//                ->render();
//            $this->customphpmailer('noreply@fitzenstudios.com', $request->email, 'Fitzen Studio - Invitation to join as trainer', $view);
            $mailData = [
                'to' => $request->email,
                'token' => $user->password,
            ];
            Mail::send('trainer.emails.invitation', $mailData, function($message) use ($mailData) {
                $message->to($mailData['to'])->subject('Fitzen Studio - Invitation to join as trainer');
            });


            DB::commit();
            return redirect()->back()->with('success', 'Trainer Created Successfully. An invitation link has sent to trainer to join.');
        }
        catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function EditTrainer($id)
    {
        $trainer = Trainer::find($id);
        $trainer = $trainer->load('timeZone');
        $schedules = CustomerToTrainer::with('customer', 'trainer')
            ->where('trainer_id', $id)
            ->orderBy('trainer_date', 'desc')
            ->paginate();
        $rating = Review::where('trainer_id', $id)->avg('rating');
        return view('admin.trainers.edit_trainer', compact('trainer', 'schedules', 'rating'))->with('timezones', TimeZone::all());
    }

    public function UpdateTrainer(Request $request)
    {
        try{
            DB::beginTransaction();
            $dirPath = "uploads/images/home";
            $update_trainer = Trainer::find($request->trainer_id);
            $update_trainer->name = $request->name;
            $update_trainer->last_name = $request->last_name;
            $update_trainer->phone = $request->phone;
            $update_trainer->gender = $request->gender;
            $update_trainer->dob = $request->dob;
            $update_trainer->age = $request->age;
            $update_trainer->weight = $request->weight;
            $update_trainer->nationality = $request->nationality;
            $update_trainer->country = $request->country;
            $update_trainer->city = $request->city;
            if ($request->days_available) {
                $update_trainer->days_available = json_encode($request->days_available);
            }
            $update_trainer->no_of_session_in_week = $request->no_of_session_in_week;
            $update_trainer->description = $request->description;
            $update_trainer->time_zone = $request->time_zone;

            if ($request->hasFile('photo')) {
                if (File::exists(public_path($dirPath . '/' . $request->photo))) {
                    File::delete(public_path($dirPath . '/' . $request->photo));
                }
                $fileName = time() . '-' . $request->photo->getClientOriginalName();
                $request->photo->move(public_path($dirPath), $fileName);
                $update_trainer->photo = $dirPath . '/' . $fileName;
            }
            $update_trainer->save();

            DB::commit();
            return redirect()->back()->with('success', 'Trainer Updated Successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id, Request $request)
    {
        try {
            DB::beginTransaction();
            $trainer = Trainer::find($id);
            CustomerToTrainer::where('trainer_id', $id)->delete();
            User::where('id', $trainer->user_id)->delete();


            $trainer->delete();
            DB::commit();
            return redirect()->back()->with('success', 'Trainer Deleted Successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function AddTrainerPayment(Request $request)
    {
        try {
            DB::beginTransaction();
            $dirPath = "uploads/images/about";
            $payment = new PaymentToTrainer();
            $payment->trainer_id = $request->trainer_id;
            if ($request->hasFile('slip')) {
                if (File::exists(public_path($dirPath . '/' . $request->slip))) {
                    File::delete(public_path($dirPath . '/' . $request->slip));
                }
                $fileName = time() . '-' . $request->slip->getClientOriginalName();
                $request->slip->move(public_path($dirPath), $fileName);
                $payment->slip = $dirPath . '/' . $fileName;
            }
            $payment->save();

            $notification_to_trainer = new Notification();
            $notification_to_trainer->sender_id = Auth::user()->id;
            $notification_to_trainer->receiver_id = $request->trainer_id;
            $notification_to_trainer->notification = "You have a new payment slip from admin";
            $notification_to_trainer->type = "Payment Slip";
            $notification_to_trainer->save();

            DB::commit();
            return redirect()->back()->with('success', 'Payment slip added successfully...!!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
