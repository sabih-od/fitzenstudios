<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Notification;

class NotificationController extends Controller
{
    public function getNotification(Request $request){

        $receiver_id        = Auth::id();
        $notification       = new Notification;
        $notifications      = $notification->where('receiver_id', $receiver_id)->with('receiver_user')->orderBy('id', 'DESC')->get();
        $notification_count = $notifications->where('is_read', 0)->count();

        if (is_null($request->session()->get('notification_count'))) {

            $notification->where('receiver_id', $receiver_id)->update(['is_read' => 1]);
            $request->session()->put('notification_count', count($notifications));
            return view('notification', compact('notifications'));
        }

        if (count($notifications) == $request->session()->get('notification_count')) {

            return 'error';

        } else if(count($notifications) != $request->session()->get('notification_count')) {

            $notification->where('receiver_id', $receiver_id)->update(['is_read' => 1]);
            session(['notification_count' => count($notifications)]);
            return view('notification', compact('notifications'));
        }

    }

    public function getMyNotifications(){

        $notifications = Notification::where('receiver_id', Auth::id())->get();

        if(count($notifications) != 0){
            return response()->json([
                'success' => 'Notifications retrived successfully',
                'data' => $notifications,
                'status' => '200'
            ]);
        }else{
            return response()->json([
                'success' => 'Notifications retrived successfully',
                'data' => [],
                'status' => '200'
            ]);
        }


    }

}
