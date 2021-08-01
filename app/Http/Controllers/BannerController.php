<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use Illuminate\Http\Request;
use Session;
use Image;

class BannerController extends Controller
{
   public function banner(){
       Session::put('page','banner');
       $banner=Banner::get();
       return view('admin.bannar.bannar')->with(compact('banner'));
   }
   public function checkBanner(Request $request){
       if($request->ajax()){
           $data=$request->all();
           if($data['status']=="Active"){
               $status=0;
           }else{
               $status=1;
           }
           Banner::where('id',$data['check_id'])->update(['status'=>$status]);
           return response()->json(['status'=>$status,'check_id'=>$data['check_id']]);
       }
   }
   public function delBanner($id){
       Banner::find($id)->delete();
       Session::flash('success','You have successfully delete Banner');
       return redirect()->back();
   }
   public function addBanner (Request $request,$id=null){
       if($id==""){
           $title="Add Banner";
           $Banner=new Banner;
           $getBanner=array();
           $msg="Added Successfully";
       }else{
           $title="Edit Banner";
           $getBanner=Banner::where('id',$id)->first();
           $getBanner=json_decode(json_encode($getBanner),true);
           //echo "<pre>";print_r($getBanner);die();
           $Banner=Banner::find($id);
           $msg="Updated Successfully";
       }
       if($request->isMethod('post')){
           if($request->hasFile('image')){
               $img_temp=$request->file('image');
            if($img_temp->isValid()){
                $extension=$img_temp->getClientOriginalExtension();
                $imageName=rand(1111,99999).'.'.$extension;
                $img_path='images/bannar_images/'.$imageName;
                Image::make($img_temp)->save($img_path);
                $Banner->image=$imageName;
            }
           }

           $data=$request->all();
           //echo "<pre>";print_r($data);die();
           $Banner->link=$data['link'];
           $Banner->title=$data['title'];
           $Banner->altTag=$data['altTag'];

           $Banner->save();
           Session::flash('success',$msg);
           return redirect('admin/banner');
       }
       return view('admin.bannar.add_banner')->with(compact('title','getBanner','msg'));
   }
   public function delBan($id){
       $catImage=Banner::select('image')->where('id',$id)->first();
       $catPath='images/bannar_images/';
       if(file_exists($catPath.$catImage->image)){
           unlink($catPath.$catImage->image);
       }
       Banner::where('id',$id)->update(['image'=>""]);
       Session::flash('success','data delete success');
       return redirect()->back();
   }
}
