<?php

namespace App\Models;
use Auth;
use Session;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    public static function userCart(){
        if(Auth::check()){
            $userCart=Cart::with(['product'=>function($query){
                $query->select('id','category_id','product_name','product_code','product_color','main_image');
            }])->where('user_id',Auth::user()->id)->get()->toArray();
        }else{
            $userCart=Cart::with(['product'=>function($query){
                $query->select('id','category_id','product_name','product_code','product_color','main_image');
            }])->where('session_id',Session::get('session_id'))->get()->toArray();
        }
        return $userCart;
    }
    public function product(){
        return $this->belongsTo('App\Models\Product','product_id') ->select('id','product_name',
        'product_code','product_color','main_image','product_name','product_discount');
    }
    public static function attrs($product_id,$size){
        $attrPrice=ProductsAttribute::select('price')->where(['product_id'=>$product_id,'size'=>$size])->first()->toArray();
        return $attrPrice['price'];
    }
}
