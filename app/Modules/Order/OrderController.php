<?php

namespace App\Modules\Order;

// namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Notification;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Traits\NotificationTrait;
class OrderController extends Controller
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

    public function orderlist()
    {
        if (auth::user()->role == 0) {
            $order = Order::with('user', 'vendor')->orderby('id','desc')->get();
        } else {
            $order = Order::with('user', 'vendor')->where('vendor_id', auth::id())->orderby('id','desc')->get();
        }

        return view('Superadmin.Order.orderlist', compact('order'));
    }

    public function order_details($id)
    {
        $order = Order::with('user', 'vendor','useraddress')->find($id);
        $OrderItem = OrderItem::with('order','product')->where('order_id',$id)->get();

        return view('Superadmin.Order.orderdetails', compact('order','OrderItem'));
    }
    public function orderstatus(Request $req)
    {
         $Order =  Order::find($req->id);
         $Order->status = $req->status;
         $Order->save();
         if($Order->status == 1){
            $message  = "Your is order is packing";
         }elseif($Order->status == 2){
            $message  = "Your is order is On going";
         }elseif($Order->status == 3){
            $message  = "Your is order is delivered";
         }
         else{
            $message  = "Your is order confirm";
         }
          $title  = "Order status";


          $user = User::find($Order->user_id);
            $notification = new Notification;
            $notification->sender_id = Auth::id();
            $notification->receiver_id =  $user->id;
            $notification->title = $title;
            $notification->message = $message;
            $notification->save();
            $this->sendNotification($user->device_token,$title,$message);

        return response()->json(['success' => 'success'], 200);
    }
}
