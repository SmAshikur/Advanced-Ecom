<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Auth;

class OrderController extends Controller
{
    public function orders(){
       $orders=Order::with('orders_products')->where('user_id',Auth::user()->id)->orderBy('id','Desc')->get()->toArray();
       //dd($orders);
       return view('user.order')->with(compact('orders'));
    }
    public function ordersDetails($id){
        $order=Order::with('orders_products')->where('id',$id)->first()->toArray();
      // dd($order);
        return view('user.order_details')->with(compact('order'));
    }
}
