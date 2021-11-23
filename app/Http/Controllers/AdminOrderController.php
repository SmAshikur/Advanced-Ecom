<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrdersLog;
use App\Models\OrderStatus;
use App\Models\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Mail;
use Session;

class AdminOrderController extends Controller
{
    public function orders(){
        Session::put('page','order');
        $orders=Order::with('orders_products')->orderBy('id','Desc')->get()->toArray();
        //dd($orders);
        return view('admin.order.adminOrder')->with(compact('orders'));
    }
    public function ordersDetails($id){
        $order=Order::with('orders_products')->where('id',$id)->first()->toArray();
        $user=User::where('id',$order['user_id'])->first()->toArray();
        $status=OrderStatus::where('status',1)->get()->toArray();
        $logs=OrdersLog::where('order_id',$id)->get()->toArray();
        //  dd($logs);
        return view('admin.order.adminOrder_details')->with(compact('order','user','status','logs'));
    }
    public function orderStatus(Request $request){
    if ($request->isMethod('post')){
        $data=$request->all();
       // dd($data);
        Order::where('id',$data['order_id'])->update(['order_status'=>$data['order_status']]);

        if(!empty($data['courier_name'] && $data['tracing_number'])&&$data['order_status']=="shipped"){
            Order::where('id',$data['order_id'])->update(['courier_name'=>$data['courier_name'],'tracking_number'=>$data['tracing_number']]);
        }

        Session::flash('success','status update successfully');
        $deliveryDetails=Order::select('mobile','name','email')->where('id',$data['order_id'])->first()->toArray();
        $message="dear ".$data['order_id']." successfully placed";
        $details=Order::with('orders_products')->where('id',$data['order_id'])->first()->toArray();
        $email=$deliveryDetails['email'];
        $name=$deliveryDetails['name'];
        $messageData=['name'=>$name,'order_id'=>$data['order_id'],'details'=>$details,'email'=>$email];
        Mail::send('emails.status',$messageData,function ($message) use($email){
            $message->to($email)->subject('Welcome to Becha Kena Bazar');
        });
        $orderLog=new OrdersLog();
        $orderLog->order_id=$data['order_id'];
        $orderLog->order_status=$data['order_status'];
        $orderLog->save();

        return redirect()->back();
    }
    }
    public function ordersInvoice($id){
        $order=Order::with('orders_products')->where('id',$id)->first()->toArray();
        $user=User::where('id',$order['user_id'])->first()->toArray();
        //  dd($logs);
        return view('admin.order.adminOrder_invoice')->with(compact('order','user'));
    }
}
