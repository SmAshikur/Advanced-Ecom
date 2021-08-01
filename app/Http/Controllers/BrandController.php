<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Session;

class BrandController extends Controller
{
    public function brand (){
        Session::put('page','brand');
        $brand= Brand::get();
        return view('admin.brand.brand')->with(compact('brand'));
    }
    public function statusCheckBrand(Request $request){
        if($request->ajax()){
            $data= $request->all();
            // echo "<pre>";print_r($data);die();
            if($data['status']=="Active"){
                $status=0;

            }else{
                $status=1;
            }
           Brand::where('id',$data['brand_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$data['status'],'brand_id'=>$data['brand_id']]);
        }
    }

    public function addBrand(Request $request,$id=null){
        if($request->id==""){
            $title="Add";
            $brandData=array();
            $brand = new Brand;
        }else{
            $title="Edit";
            $brand=Brand::find($id);
            $brandData=Brand::where('id',$id)->first();
            $brandData=json_decode(json_encode($brandData),true);
            //echo "<pre>";print_r($brandData);die();
        }
        if ($request->isMethod('post')){
            $data =$request->all();
             //echo "<pre>";print_r($data);die();

            $brand->name=$data['name'];
            $brand->save();
            Session::flash('success','data recorded success');
            return redirect('/admin/brands' );

        }
        return view('admin.brand.add_brand')->with(compact('title','brandData'));
    }
    public function delBrand($id){
        Brand::where('id',$id)->delete();
        Session::flash('fail','kam tamam');
        return redirect()->back();
    }
    public function checkBrand (Request $request){
        if($request->ajax()){
            $data=$request->all();
            //echo "<pre>";print_r($data);die;
            if($data['status']=="Active"){
                $status=0;
            }else{
                $status=1;
            }
            Brand::where('id',$data['check_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'check_id'=>$data['check_id']]);
        }
    }
}
