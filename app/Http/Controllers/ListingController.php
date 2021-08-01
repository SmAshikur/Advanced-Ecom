<?php

namespace App\Http\Controllers;
use App\Models\Cart;
use App\Models\ProductsAttribute;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Auth;
use Session;

class ListingController extends Controller
{

    public function listing( Request $request){
       if($request->ajax()){
           $data=$request->all();
           $url=$data['url'];
         // echo "<pre>";print_r($data);die();
           $catCount = Category::where(['url'=>$url,'status'=>1])->count();
           $url=$data['url'];
           if ($catCount > 0) {
               $categoryDetails = Category::catDetails($url);
               //echo "<pre>";print_r($catDetails);die();
               $catPro = Product::with('brand')->whereIn('category_id', $categoryDetails['catIds'])->where('status', 1);
               //echo "<pre>";print_r($catPro);die();
               if (isset($data['fab']) && !empty($data['fab'])) {
                   $catPro->whereIn('products.fabric',$data['fab']);
               }
               if (isset($data['sleeve']) && !empty($data['sleeve'])) {
                   $catPro->whereIn('products.sleeve',$data['sleeve']);
               }
               if (isset($data['pattern']) && !empty($data['pattern'])) {
                   $catPro->whereIn('products.pattern',$data['pattern']);
               }
               if (isset($data['fit']) && !empty($data['fit'])) {
                   $catPro->whereIn('products.fit',$data['fit']);
               }
               if (isset($data['occasion']) && !empty($data['occasion'])) {
                   $catPro->whereIn('products.occasion',$data['occasion']);
               }


               if (isset($data['sort']) && !empty($data['sort'])) {
                   if ($data['sort'] == 'latest') {
                       $catPro->orderBy('id', 'Desc');
                   } elseif ($data['sort'] == 'a_z') {
                       $catPro->orderBy('product_name', 'Asc');
                   } elseif ($data['sort'] == 'z_a') {
                       $catPro->orderBy('product_name', 'Desc');
                   } elseif ($data['sort'] == 'low') {
                       $catPro->orderBy('product_price', 'Asc');
                   } elseif ($data['sort'] == 'high') {
                       $catPro->orderBy('product_price', 'Desc');
                   }

               } else {
                   $catPro->orderBy('id', 'Desc');
               }

               $catPro = $catPro->paginate(5);

               return view('user.ajax')->with(compact('categoryDetails', 'catPro', 'url'));
           } else {
               abort(404);
           }
       }else {

            $url=Route::getFacadeRoot()->current()->uri();
           $catCount = Category::where(['url'=>$url,'status'=>1])->count();
           if ($catCount > 0) {
               $categoryDetails = Category::catDetails($url);
               //echo "<pre>";print_r($catDetails);die();
               $catPro = Product::with('brand')->whereIn('category_id', $categoryDetails['catIds'])->where('status', 1);
               //echo "<pre>";print_r($catPro);die();
               $catPro = $catPro->paginate(5);
                $page_name="listing";
               $proFilter=Product::filter();
               //echo"<pre>";print_r($proFilter);die();
               $fabArry=$proFilter['fabArry'];
               $sleeveArry=$proFilter['sleeveArry'];
               $patternArry=$proFilter['patternArry'];
               $fitArry=$proFilter['fitArry'];
               $occasionArry=$proFilter['occasionArry'];

               return view('user.listing')->with(compact('categoryDetails', 'catPro', 'url',
                   'fabArry','fitArry','patternArry','occasionArry','sleeveArry','page_name'));
           } else {
               abort(404);
           }

       }
   }



   public function proDetails ($product_name,$product_code,$id){
        $proDetails=Product::with(['brand','category','attrs'=>function($query){
            $query->where('status',1);
        },'attrsImg'])->find($id)->toArray();
        $stock=ProductsAttribute::where('product_id',$id)->sum('stock');
        $related=Product::where('category_id',$proDetails['category']['id'])->where('id','!=',$id)->limit(3)->
        inRandomOrder()->get()->toArray();
      // dd($related);
    return view('user.pro_details')->with(compact('proDetails','stock','related'));
   }

   public function changePrice(Request $request){
        if ($request->ajax()){
            $data=$request->all();
           // echo "<pre>";print_r($data);die();

           //$getPro= ProductsAttribute::where(['product_id'=>$data['p_id'],'size'=>$data['size']])->first();
            $desPrice=Product:: attrDiscount($data['product_id'],$data['size']);
            //echo "<pre>";print_r($desPrice);die();
            //return  response()->json(['price'=>$getPro['price'],'stock'=>$getPro['stock'] ]);
            return $desPrice;
        }
   }

   public function addCart(Request $request){
        if($request->isMethod('post')){
            $data=$request->all();
            //echo "<pre>";print_r($data);die();
            $getPro=ProductsAttribute::with('product')->where(['product_id'=>$data['product_id'],'size'=>$data['size']])->first()->toArray();
          //  echo "<pre>";print_r($getPro);die();
            if($getPro['stock']< $data['quantity']){
                $message="We dont have this amount of".$getPro['product']['product_name'];
                Session::flash('fail',$message);
                return redirect()->back();
            }
            if(Auth::check()){
                $countPro=Cart::where(['product_id'=>$data['product_id'],'size'=>$data['size'],'user_id'=>Auth::user()->id])->count();
            }else{
                $countPro=Cart::where(['product_id'=>$data['product_id'],'size'=>$data['size'],'session_id'=>Session::get('session_id')])->count();
            }
            if($countPro>0){
                $message=$getPro['product']['product_name']." "."already in cart";
                Session::flash('fail',$message);
                return redirect()->back();
            }

            $session_id=Session::get('session_id');
            if(empty($session_id)){
                $session_id=Session::getId();
                Session::put('session_id',$session_id);
            }
            if(Auth::check()){
                $user_id=Auth::user()->id;
            }else{
                $user_id="";
            }

            $cart= new Cart;
            $cart->session_id=$session_id;
            $cart->user_id=$user_id;
            $cart->product_id=$data['product_id'];
            $cart->size=$data['size'];
            $cart->quantity=$data['quantity'];
            $cart->save();
            $message="you have successfully add "." ".$getPro['product']['product_name'] ;
            Session::flash('success',$message);
            return redirect()->back();
        }
   }

   public function cart(){
        $userCart=Cart::userCart();

        return view('user.cart')->with(compact('userCart'));
   }
   public function changeQuantity(Request $request){
        if ($request->isMethod('post')){
            $data=$request->all();
           // echo "<pre>";print_r($data);die();
            $cartDetails=Cart::find($data['cartId']);
            $stockC=ProductsAttribute::where(['product_id'=>$cartDetails['product_id'],'size'=>$cartDetails['size']])->select('stock')->first()->toArray();
            if($data['new_quantity']>$stockC['stock']){
                $userCart=Cart::userCart();
                return response()->json([
                    'status'=>false,
                    'msg'=>"no size available",
                    'view'=>(String)View::make('user.cart_item')->with(compact('userCart'))]);
            }
            $sizeZ=ProductsAttribute::where(['product_id'=>$cartDetails['product_id'],'size'=>$cartDetails['size'],'status'=>1])->count();
            if($sizeZ==0){
                $userCart=Cart::userCart();
                return response()->json([
                    'status'=>false,
                    'msg'=>"out os stock",
                    'view'=>(String)View::make('user.cart_item')->with(compact('userCart'))]);
            }

            Cart::where('id',$data['cartId'])->update(['quantity'=>$data['new_quantity']]);
            $userCart=Cart::userCart();
            return response()->json([
                'status'=>true,
                'view'=>(String)View::make('user.cart_item')->with(compact('userCart'))]);
        }
   }
    public function deleteQuantity(Request $request){
        if ($request->isMethod('post')){
            $data=$request->all();
            // echo "<pre>";print_r($data);die();
            Cart::where('id',$data['cartId'])->delete();
            $userCart=Cart::userCart();
            return response()->json(['view'=>(String)View::make('user.cart_item')->with(compact('userCart'))]);
        }
    }


}
