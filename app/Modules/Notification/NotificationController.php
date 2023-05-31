<?php

namespace App\Modules\Notification;

// namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Traits\NotificationTrait;
class NotificationController extends Controller
{
    use NotificationTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function notification()
    {
        $users = User::where('role',3)->get();
        return view('Superadmin.Notification.notification',compact('users'));
    }

  public function notificationSend(Request $request){



    if($request->alluser){
        $users = User::where('role',3)->get();
    }else{
        $id = implode(',',$request->users);
        $users = User::whereIn('id',explode(',',$id))->get();
    }

        foreach($users as $singleuser){
            $notification = new Notification;
            $notification->sender_id = Auth::id();
            $notification->receiver_id =  $singleuser->id;
            $notification->title = $request->title;
            $notification->message = $request->message;
            $notification->save();
            $this->sendNotification($singleuser->device_token,$request->title,$request->message);
        }

       return redirect()->back()->with('message', 'Notification Send Successfully');
    }

}
