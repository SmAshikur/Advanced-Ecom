<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function category(){
        return $this->belongsTo('App\Models\Category','category_id') ;//->select('id','category_name');
    }
    public function section(){
        return $this->belongsTo('App\Models\Section','section_id');//->select('id','name');
    }
    public function brand(){
        return $this->belongsTo('App\Models\Brand','brand_id');//->select('id','name');
    }
    public function attrs(){
        return $this->hasMany('App\Models\ProductsAttribute');//->select('id','name');
    }
    public function attrsImg(){
        return $this->hasMany('App\Models\ProductsImage');//->select('id','name');
    }
    public static function filter(){
        $proFilter['fabArry']= array('Cotton','Polyester','Wool');
        $proFilter['sleeveArry']= array('Full sleeve','Half sleeve','Short sleeve','sleeveless');
        $proFilter['patternArry']= array('Checked','Plain','Printed','self','solid');
        $proFilter['fitArry']= array('Regular','Slim');
        $proFilter['occasionArry']= array('Casual','Formal');
        return $proFilter;
    }
    public static function discount ($product_id){
     $pro=Product::where('id',$product_id)->select('product_price','product_discount','category_id')->first()->toArray();
    // echo "<pre>";print_r($pro);die();
        $cat=Category::where('id',$pro['category_id'])->select('category_discount')->first()->toArray();
       // echo "<pre>";print_r($cat);die();
        if($pro['product_discount']>0){
            $discountedPrice=$pro['product_price']-($pro['product_price']*$pro['product_discount']/100);
        }else if($cat['category_discount']>0){
            $discountedPrice=$pro['product_price']-($pro['product_price']*$cat['category_discount']/100);
        }else{
            $discountedPrice=0;
        }
        return   $discountedPrice;
    }
    public static function attrDiscount ($product_id,$size){
        $attrPrice=ProductsAttribute::where(['product_id'=>$product_id,'size'=>$size])->first()->toArray();
        $pro=Product::where('id',$product_id)->select('product_discount','category_id')->first()->toArray();
        // echo "<pre>";print_r($pro);die();
        $cat=Category::where('id',$pro['category_id'])->select('category_discount')->first()->toArray();

        // echo "<pre>";print_r($cat);die();
        if($pro['product_discount']>0){
            $discountedPrice=$attrPrice['price']-($attrPrice['price']*$pro['product_discount']/100);
            $discount=$attrPrice['price']- $discountedPrice ;
        }else if($cat['category_discount']>0){
            $discountedPrice=$attrPrice['price']-($attrPrice['price']*$cat['category_discount']/100);
            $discount=$attrPrice['price']- $discountedPrice ;
        }else{
            $discountedPrice=0;
            $discount=$attrPrice['price']- $discountedPrice ;
        }

        return  array('product_price'=>$attrPrice['price'],'discounted_price'=> $discountedPrice,'stock'=>$attrPrice['stock'],'discount'=> $discount) ;
    }


}
