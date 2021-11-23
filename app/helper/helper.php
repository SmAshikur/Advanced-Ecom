<?php
use App\Models\Cart;
function totalCartItems(){
    if(Auth::check()){
        $totalCartItems=Cart::where('user_id',Auth::user()->id)->sum('quantity');
    }else{
        $totalCartItems=Cart::where('session_id',Session::get('session_id'))->sum('quantity');
    }
    return $totalCartItems;
}
