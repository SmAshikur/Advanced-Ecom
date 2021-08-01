<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Section;
use Illuminate\Http\Request;
use Image;
use Session;

class CategoryController extends Controller
{
    public function category(){
        Session::put('page','category');
        $cats=Category::with('category','section')->get();
      // $c=json_decode(json_encode($cats));
     // echo "<pre>";print_r($c);die();
        return view('admin.category.category')->with(compact('cats'));
    }
    public function checkCategory(Request $request){
        if($request->ajax()){
            $data=$request->all();
            //echo "<pre>";print_r($data);die;
            if($data['status']=="Active"){
                $status=0;
            }else{
                $status=1;
            }
            Category::where('id',$data['check_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'check_id'=>$data['check_id']]);
        }
    }
    public function addCat(Request $request, $id=null){
        if($id==""){
            $title="Add Category";
            $cats = new  Category;
            $catData= array();
            $getCats=array();
        }else{
            $title="Edit Category";
            $catData=Category::where('id',$id)->first();
            $getCats= Category::with('subcategories')->where(['section_id'=>$catData['section_id'],'parent_id'=>0,])->get();

            $cats =  Category::find($id);

            //$c=json_decode(json_encode($catData));
             //echo "<pre>";print_r($c);die();









        }
      if($request->isMethod('post')){
       $data=$request->all();
          $rules=[
              'category_name' => 'required|max:255',
              'section_id' => 'required',
              'url' => 'required',
              'category_image' => 'image',
          ];
          $customMessages=[
              'category_name.mim'=>'nam th diba vai',
              //'mobile.required'=>'mob de',
              'section_id.required'=>'kon sa section',
              'url.required'=>'kon sa url',
              'category_image.image'=>'valo pic de'
          ];
          $this->validate($request,$rules,$customMessages);



       if($request->hasFile('category_image')){
           $img_temp=$request->file('category_image');
           if($img_temp->isValid()){
               $ext=$img_temp->getClientOriginalExtension();
               $imgName=rand(111,9999).'.'.$ext;
               $imgPath='images/cat_images/'.$imgName;
               Image::make($img_temp)->save($imgPath);
               $cats->category_image = $imgName;
           }
       }
           if(empty($data['meta_title'])){
               $data['meta_title']="";
           }
          if(empty($data['category_discount'])){
              $data['category_discount']=0;
          }
          if(empty($data['description'])){
              $data['description']="";
          }
          if(empty($data['meta_description'])){
              $data['meta_description']="";
          }
          if(empty($data['meta_keywords'])){
              $data['meta_keywords']="";
          }






         //   echo "<pre>";print_r($data);die();
             $cats->category_name =$data['category_name'];
             $cats->parent_id = $data['parent_id'];
             $cats->section_id = $data['section_id'];
             $cats->category_name = $data['category_name'];
             $cats->category_discount = $data['category_discount'];
             $cats->url = $data['url'];
             $cats->description = $data['description'];
             $cats->meta_title = $data['meta_title'];
             $cats->meta_description = $data['meta_description'];
             $cats->meta_keywords = $data['meta_keywords'];

             $cats->status = 1;
             $cats->save();
          Session::flash('success','data recorded success');
          return redirect('admin/category');

    }
        $getSection =Section::get();
        return view('admin.category.add_category')->with(compact('title','getSection','catData','getCats'));
    }
    public function appendCheck (Request $request){
        if($request->ajax()){
            $data=$request->all();
           // echo "<pre>";print_r($data);die();
            $getCats= Category::with('subcategories')->where(['section_id'=>$data['section_id'],'parent_id'=>0,'status'=>1])->get();
            $getCats=json_decode(json_encode($getCats),true);
             //echo "<pre>";print_r($getCats);die();
            return view('admin.category.add_categoryAppend')->with(compact('getCats'));
        }
    }

    public function delImg($id){
        $catImage=Category::select('category_image')->where('id',$id)->first();
        $catPath='images/cat_images/';
        if(file_exists($catPath.$catImage->category_image)){
            unlink($catPath.$catImage->category_image);
        }
        Category::where('id',$id)->update(['category_image'=>""]);
        Session::flash('success','data recorded success');
        return redirect()->back();
    }
    public function delCat($id){
        Category::where('id',$id)->delete();
        Session::flash('fail','data delete success');
        return redirect()->back();
    }
}
