<?php

namespace App\Http\Controllers;

use App\Models\Coupon;
use App\Models\Section;
use App\Models\User;
use Illuminate\Http\Request;
use Session;

class CouponController extends Controller
{
    public function coupon (){
        Session::put('page','coupon');
        $coupon= Coupon::get()->toArray();
      // dd($coupon);
        return view('admin.coupon.coupon')->with(compact('coupon'));
    }
    public function checkCoupon(Request $request){
        if($request->ajax()){
            $data=$request->all();
            if($data['status']=="Active"){
                $status=0;
            }else{
                $status=1;
            }
            Coupon::where('id',$data['check_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'check_id'=>$data['check_id']]);
        }
    }
    public function addCoupon(Request $request, $id=null){
        if($id==""){
            $title="Add Coupon";
            $coupon= new Coupon;
            $couponData= "";
            $selCats=Array();
            $selUsers=Array();
            $msg="Coupon Add Successfully";
        }else{
            $title="Edit Coupon";
            $coupon= Coupon::find($id);
            $selCats=explode(',',$coupon['categories']);
            $selUsers=explode(',',$coupon['users']);
            $couponData= Coupon::where('id',$id)->first()->toArray();
            $msg="Coupon update Successfully";
        }
        if($request->isMethod('post')){
            $data=$request->all();
          //  echo "<pre>";print_r($data);die();
            if(isset($data['category'])){
                $cats=implode(',',$data['category']);
            }
            if(isset($data['user'])){
                $users=implode(',',$data['user']);
            }
            if(($data['coupon_option']=="automatic")){
                $coupon_code=rand(8);
            }else{
                $coupon_code=$data['coupon_code'];
            }
            $coupon->coupon_option=$data['coupon_option'];
            $coupon->coupon_code=$coupon_code;
            $coupon->categories=$cats;
            $coupon->users=$users;
            $coupon->coupon_type=$data['coupon_type'];
            $coupon->amount_type=$data['amount_type'];
            $coupon->amount=$data['amount'];
            $coupon->expire_date=$data['expire_date'];
            $coupon->save();
            Session::flash('success',$msg);
            return redirect('/admin/coupon');
        }
        $categories=Section::with('categories')->get();
        $categories=json_decode(json_encode($categories),true);
        $users=User::select('email','name')->where('status',1)->get()->toArray();
        return view('admin.coupon.add_coupon')->with(compact('selCats','selUsers','users','coupon','title','categories','couponData'));
    }
    public function delCoupon($id){
        Coupon::where('id',$id)->delete();
        Session::flash('fail','data delete success');
        return redirect()->back();
    }
}
