<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductsAttribute;
use App\Models\ProductsImage;
use App\Models\Section;
use Illuminate\Http\Request;
use Session;
use Image;

class ProductController extends Controller
{
    public function products (){
        Session::put('page','products');
        $product= Product::with(['category'=>function($query){
            $query->select('id','category_name');
        },'section'=>function($query){
            $query->select('id','name');
        }])->get();
       //$p=json_decode(json_encode($product));
      // echo "<pre>";print_r($p);die();
        return view('admin.product.product')->with(compact('product'));
    }

    public function checkProduct (Request $request){
        if($request->ajax()){
            $data=$request->all();
            //echo "<pre>";print_r($data);die;
            if($data['status']=="Active"){
                $status=0;
            }else{
                $status=1;
            }
            Product::where('id',$data['check_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'check_id'=>$data['check_id']]);
        }
    }

    public function addPro(Request $request,$id=null){
        if(empty($id)){
            $title="Add Product";
            $product = new Product;
            $proData=array();
        }else{
            $title="Edit Product";
            $proData=Product::where('id',$id)->first();
            $product = Product::find($id);
            $proData=json_decode(json_encode($proData),true);
             //echo "<pre>";print_r($proData);die();
        }


        if($request->isMethod('post')){
            $data=$request->all();
            //echo "<pre>";print_r($data);die();
            $rules=[
                'category_id' => 'required',
                'product_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'product_code' => 'required|regex:/^[\w-]*$/',
                'product_price' => 'required|numeric',
                'product_color' => 'required|regex:/^[\pL\s\-]+$/u',
            ];
            $customMessages=[
                'category_id.required'=>'category is required',
                'product_name.required'=>'name is required',
                'product_name.regex'=>'valid name is required',
                'product_code.required'=>'code is required',
                'product_code.regex'=>'valid code is required',
                'product_price.required'=>'price is required',
                'product_price.numericcolor'=>'valid price is required',
                'product_color.required'=>'color is required',
                'product_color.regex'=>'valid color is required',
            ];
            $this->validate($request,$rules,$customMessages);

            if($request->hasFile('main_image')){
                $img_temp=$request->file('main_image');
                //echo "<pre>";print_r($img_temp);die();
                if($img_temp->isValid()){
                    $img_name=$img_temp->getClientOriginalName();
                    $ext=$img_temp->getClientOriginalExtension();
                    $imgName=$img_name.'_'.rand(111,99999).'.'.$ext;
                    $large_imgPath='images/product_images/large/'.$imgName;
                    $medium_imgPath='images/product_images/medium/'.$imgName;
                    $small_imgPath='images/product_images/small/'.$imgName;
                    Image::make($img_temp)->save($large_imgPath);
                    Image::make($img_temp)->resize(520,600)->save($medium_imgPath);
                    Image::make($img_temp)->resize(260,300)->save($small_imgPath);
                    $product->main_image = $imgName;
                  //  $product->main_image=" ";
                }
            }
            if($request->hasFile('product_video')){
                $video_tmp=$request->file('product_video');
               // echo "<pre>";print_r($video_tmp);die();
                if ($video_tmp->isValid()){
                    $video_name=$video_tmp->getClientOriginalName();
                    $ext=$video_tmp->getClientOriginalExtension();
                    $videoName=$video_name.'_'.rand().'.'.$ext;
                    $video_path='images/videos/';
                    $video_tmp->move($video_path,$videoName);
                    $product->product_video=$videoName;
                }
            }
            if(empty($data['is_featured'])){
                $is_featured='no';
                // $product->is_featured= $is_featured;
            }else{
                $is_featured='yes';
            }


            if(empty($data['product_discount'])){
                $data['product_discount']=0;
            }
            if(empty($data['product_weight'])){
                $data['product_weight']=0;
            }
            if(empty($data['fabric'])){
                $data['fabric']="";
            }
            if(empty($data['description'])){
                $data['description']="";
            }
            if(empty($data['wash_care'])){
                $data['wash_care']="";
            }
            if(empty($data['pattern'])){
                $data['pattern']="";
            }
            if(empty($data['sleeve'])){
                $data['sleeve']="";
            }
            if(empty($data['occasion'])){
                $data['occasion']="";
            }
            if(empty($data['fit'])){
                $data['fit']="";
            }
            if(empty($data['meta_title'])){
                $data['meta_title']="";
            }
            if(empty($data['meta_keywords'])){
                $data['meta_keywords']="";
            }
            if(empty($data['meta_description'])){
                $data['meta_description']="";
            }





            $catsDetails=Category::find($data['category_id']);
            $product->section_id=$catsDetails['section_id'];
            $product->category_id=$data['category_id'];
            $product->brand_id=$data['brand_id'];
            $product->product_name=$data['product_name'];
            $product->product_code=$data['product_code'];
            $product->product_color=$data['product_color'];
            $product->product_price=$data['product_price'];
            $product->product_discount=$data['product_discount'];
            $product->product_weight=$data['product_weight'];
            $product->description=$data['description'];
            $product->wash_care=$data['wash_care'];
            $product->fabric=$data['fabric'];
            $product->pattern=$data['pattern'];
            $product->sleeve=$data['sleeve'];
            $product->fit=$data['fit'];
            $product->occasion=$data['occasion'];
            $product->meta_title = $data['meta_title'];
            $product->meta_description = $data['meta_description'];
            $product->meta_keywords = $data['meta_keywords'];

            $product->is_featured= $is_featured;
            $product->status = 1;
            $product->save();


            Session::flash('success','data recorded success');
            return redirect('admin/products');





        }
        $proFilter=Product::filter();
        //echo"<pre>";print_r($proFilter);die();
        $fabArry=$proFilter['fabArry'];
        $sleeveArry=$proFilter['sleeveArry'];
        $patternArry=$proFilter['patternArry'];
        $fitArry=$proFilter['fitArry'];
        $occasionArry=$proFilter['occasionArry'];
        $brands=Brand::where('status',1)->get();
        $brands=json_decode(json_encode($brands),true);
    // echo"<pre>";print_r($brands);die();

        $categories=Section::with('categories')->get();
        $categories=json_decode(json_encode($categories),true); //echo "<pre>";print_r($categories);die();

        return view('admin.product.add_product')->with(compact('title','proData','fabArry','fitArry','patternArry','sleeveArry','occasionArry','categories','brands'));
    }

    public function delPro($id){
        Product::where('id',$id)->delete();
        Session::flash('fail','data delete success');
        return redirect()->back();
    }

    public function delPImg($id){
        $proImage=Product::select('main_image')->where('id',$id)->first();
        $proPath1='images/product_images/small';
        $proPath2='images/product_images/small';
        $proPath3='images/product_images/small';
        if(file_exists($proPath1.$proImage->main_image)){
            unlink($proPath1.$proImage->main_image);
        }
        if(file_exists($proPath2.$proImage->main_image)){
            unlink($proPath1.$proImage->main_image);
        }
        if(file_exists($proPath3.$proImage->main_image)){
            unlink($proPath1.$proImage->main_image);
        }
        Product::where('id',$id)->update(['main_image'=>""]);
        Session::flash('success','data recorded success');
        return redirect()->back();
    }

    public function delPVideo ($id){
        $proVid=Product::select('product_video')->where('id',$id)->first();
        $proVPath='images/videos';
        if(file_exists($proVPath.$proVid->product_video)){
            unlink($proVPath.$proVid->product_video);
        }
        Product::where('id',$id)->update(['product_video'=>""]);
        Session::flash('success','data recorded success');
        return redirect()->back();
    }

    //attr
    public function addAttr(Request $request, $id){
        if ($request->isMethod('post')){
            $data=$request->all();
            //echo "<pre>";print_r($data);die();
            foreach ($data['sku'] as $key => $val){
                if (!empty($val)){

                    $attrSku= ProductsAttribute::where('sku',$val)->count();
                    if($attrSku>0){
                        Session::flash('fail','Sku Aleady exist');
                        return redirect()->back();
                    }
                    $attrSize= ProductsAttribute::where(['product_id'=>$id,'size'=>$data['size'][$key]])->count();
                    if($attrSize>0){
                        Session::flash('fail','Size Aleady exist');
                        return redirect()->back();
                    }

                    $attr = new ProductsAttribute();
                    $attr->product_id= $id;
                    $attr->sku=$val;
                    $attr->size=$data['size'][$key];
                    $attr->price=$data['price'][$key];
                    $attr->stock=$data['stock'][$key];
                    $attr->save();
                }

            }
            Session::flash('success','done');
            return redirect()->back();
        }
        $proData=Product::select('id','product_name','product_code','product_color','main_image')-> with('attrs')->find($id);
        $proData =json_decode(json_encode($proData),true);
        $title="Add Product Attribute";
         //echo "<pre>";print_r($proData);die();
        return view('admin.product.add_productAttr')->with(compact('proData','title'));
    }

    public function editAttr(Request $request , $id){
        if ($request->isMethod('post')){
            $data=$request->all();
            //echo "<pre>";print_r($data);die();
            foreach ($data['atrrId'] as $key => $attr){
                if(!empty($attr)){
                    ProductsAttribute::where(['id'=>$data['atrrId'][$key]])->update(['price'=>$data['price'][$key],'stock'=>$data['stock'][$key]]);
                }
                Session::flash('success','data recorded success');
                return redirect()->back();
            }
        }
    }

    public function checkPro(Request $request){
        if($request->ajax()){
            $data=$request->all();
           //echo "<pre>";print_r($data);die;
            if($data['status']=="Active"){
                $status=0;
            }else{
                $status=1;
            }
            ProductsAttribute::where('id',$data['check_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'check_id'=>$data['check_id']]);
        }
    }

    public function delAttr($id){
        ProductsAttribute::where('id',$id)->delete();
        Session::flash('fail2','data delete success');
        return redirect()->back();
    }

    public function addAttrImg(Request $request,$id){
        if($request->isMethod('post')){
            $data=$request->all();
            if ($request->hasFile('image')){
                $images=$request->file('image');
               // echo "<pre>";print_r($img_tmp);die();
                foreach ($images as $image){
                    $pImage= new ProductsImage;
                    $img_temp=Image::make($image);
                    $ext=$image->getClientOriginalExtension();
                    $imgName=rand(111,9999).time().'.'.$ext;
                    $large_imgPath='images/product_images/large/'.$imgName;
                    $medium_imgPath='images/product_images/medium/'.$imgName;
                    $small_imgPath='images/product_images/small/'.$imgName;
                    Image::make($img_temp)->save($large_imgPath);
                    Image::make($img_temp)->resize(520,600)->save($medium_imgPath);
                    Image::make($img_temp)->resize(260,300)->save($small_imgPath);
                    $pImage->product_id=$id;
                    $pImage->image=$imgName;
                    $pImage->save();
                }
                Session::flash('fail2','data delete success');
                return redirect()->back();
            }
        }

        $title="Add Image";
        $proData=Product::select('id','product_name','product_code','product_color','main_image')->with('attrsImg')->find($id);
        $proData=json_decode(json_encode($proData),true);
       // echo "<pre>";print_r($proData);die();
        return view('admin.product.add_productImg')->with(compact('proData','title'));
    }

    public function delAttrImg($id){
        ProductsImage::where('id',$id)->delete();
        Session::flash('fail2','data delete success');
        return redirect()->back();
    }

    public function checkProductImg (Request $request){
        if($request->ajax()){
            $data=$request->all();
            //echo "<pre>";print_r($data);die;
            if($data['status']=="Active"){
                $status=0;
            }else{
                $status=1;
            }
            ProductsImage::where('id',$data['check_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'check_id'=>$data['check_id']]);
        }
    }

}
