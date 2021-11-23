<?php

namespace App\Http\Controllers;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\DeliveryAddress;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\ProductsAttribute;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Auth;
use Session;

class ListingController extends Controller
{

    public function listing(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            $url = $data['url'];
            // echo "<pre>";print_r($data);die();
            $catCount = Category::where(['url' => $url, 'status' => 1])->count();
            $url = $data['url'];
            if ($catCount > 0) {
                $categoryDetails = Category::catDetails($url);
                //echo "<pre>";print_r($catDetails);die();
                $catPro = Product::with('brand')->whereIn('category_id', $categoryDetails['catIds'])->where('status', 1);
                //echo "<pre>";print_r($catPro);die();
                if (isset($data['fab']) && !empty($data['fab'])) {
                    $catPro->whereIn('products.fabric', $data['fab']);
                }
                if (isset($data['sleeve']) && !empty($data['sleeve'])) {
                    $catPro->whereIn('products.sleeve', $data['sleeve']);
                }
                if (isset($data['pattern']) && !empty($data['pattern'])) {
                    $catPro->whereIn('products.pattern', $data['pattern']);
                }
                if (isset($data['fit']) && !empty($data['fit'])) {
                    $catPro->whereIn('products.fit', $data['fit']);
                }
                if (isset($data['occasion']) && !empty($data['occasion'])) {
                    $catPro->whereIn('products.occasion', $data['occasion']);
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
        } else {

            $url = Route::getFacadeRoot()->current()->uri();
            $catCount = Category::where(['url' => $url, 'status' => 1])->count();
            if ($catCount > 0) {
                $categoryDetails = Category::catDetails($url);
                //echo "<pre>";print_r($catDetails);die();
                $catPro = Product::with('brand')->whereIn('category_id', $categoryDetails['catIds'])->where('status', 1);
                //echo "<pre>";print_r($catPro);die();
                $catPro = $catPro->paginate(5);
                $page_name = "listing";
                $proFilter = Product::filter();
                //echo"<pre>";print_r($proFilter);die();
                $fabArry = $proFilter['fabArry'];
                $sleeveArry = $proFilter['sleeveArry'];
                $patternArry = $proFilter['patternArry'];
                $fitArry = $proFilter['fitArry'];
                $occasionArry = $proFilter['occasionArry'];

                return view('user.listing')->with(compact('categoryDetails', 'catPro', 'url',
                    'fabArry', 'fitArry', 'patternArry', 'occasionArry', 'sleeveArry', 'page_name'));
            } else {
                abort(404);
            }

        }
    }


    public function proDetails($product_name, $product_code, $id)
    {
        $proDetails = Product::with(['brand', 'category', 'attrs' => function ($query) {
            $query->where('status', 1);
        }, 'attrsImg'])->find($id)->toArray();
        $stock = ProductsAttribute::where('product_id', $id)->sum('stock');
        $related = Product::where('category_id', $proDetails['category']['id'])->where('id', '!=', $id)->limit(3)->
        inRandomOrder()->get()->toArray();
        // dd($related);
        return view('user.pro_details')->with(compact('proDetails', 'stock', 'related'));
    }

    public function changePrice(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            // echo "<pre>";print_r($data);die();

            //$getPro= ProductsAttribute::where(['product_id'=>$data['p_id'],'size'=>$data['size']])->first();
            $desPrice = Product:: attrDiscount($data['product_id'], $data['size']);
            //echo "<pre>";print_r($desPrice);die();
            //return  response()->json(['price'=>$getPro['price'],'stock'=>$getPro['stock'] ]);
            return $desPrice;
        }
    }

    public function addCart(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            //echo "<pre>";print_r($data);die();
            $getPro = ProductsAttribute::with('product')->where(['product_id' => $data['product_id'], 'size' => $data['size']])->first()->toArray();
            //  echo "<pre>";print_r($getPro);die();
            if ($getPro['stock'] < $data['quantity']) {
                $message = "We dont have this amount of" . $getPro['product']['product_name'];
                Session::flash('fail', $message);
                return redirect()->back();
            }
            if (Auth::check()) {
                $countPro = Cart::where(['product_id' => $data['product_id'], 'size' => $data['size'], 'user_id' => Auth::user()->id])->count();
            } else {
                $countPro = Cart::where(['product_id' => $data['product_id'], 'size' => $data['size'], 'session_id' => Session::get('session_id')])->count();
            }
            if ($countPro > 0) {
                $message = $getPro['product']['product_name'] . " " . "already in cart";
                Session::flash('fail', $message);
                return redirect()->back();
            }

            $session_id = Session::get('session_id');
            if (empty($session_id)) {
                $session_id = Session::getId();
                Session::put('session_id', $session_id);
            }
            if (Auth::check()) {
                $user_id = Auth::user()->id;
            } else {
                $user_id = "";
            }

            $cart = new Cart;
            $cart->session_id = $session_id;
            $cart->user_id = $user_id;
            $cart->product_id = $data['product_id'];
            $cart->size = $data['size'];
            $cart->quantity = $data['quantity'];
            $cart->save();
            $message = "you have successfully add " . " " . $getPro['product']['product_name'];
            Session::flash('success', $message);
            return redirect()->back();
        }
    }

    public function cart()
    {
        $userCart = Cart::userCart();
        return view('user.cart')->with(compact('userCart'));
    }

    public function changeQuantity(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>";print_r($data);die();
            $cartDetails = Cart::find($data['cartId']);
            $stockC = ProductsAttribute::where(['product_id' => $cartDetails['product_id'], 'size' => $cartDetails['size']])->select('stock')->first()->toArray();
            if ($data['new_quantity'] > $stockC['stock']) {
                $userCart = Cart::userCart();
                return response()->json([
                    'status' => false,
                    'msg' => "no size available",
                    'view' => (string)View::make('user.cart_item')->with(compact('userCart'))]);
            }
            $sizeZ = ProductsAttribute::where(['product_id' => $cartDetails['product_id'], 'size' => $cartDetails['size'], 'status' => 1])->count();
            if ($sizeZ == 0) {
                $userCart = Cart::userCart();
                return response()->json([
                    'status' => false,
                    'msg' => "out os stock",
                    'view' => (string)View::make('user.cart_item')->with(compact('userCart'))]);
            }

            Cart::where('id', $data['cartId'])->update(['quantity' => $data['new_quantity']]);
            $userCart = Cart::userCart();
            $totalCartItems = totalCartItems();
            return response()->json([
                'status' => true,
                'totalCartItems' => $totalCartItems,
                'view' => (string)View::make('user.cart_item')->with(compact('userCart'))]);
        }
    }

    public function deleteQuantity(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>";print_r($data);die();
            Cart::where('id', $data['cartId'])->delete();
            $userCart = Cart::userCart();
            $totalCartItems = totalCartItems();
            return response()->json([
                'totalCartItems' => $totalCartItems,
                'view' => (string)View::make('user.cart_item')->with(compact('userCart'))]);
        }
    }

    public function applCoupon(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            echo "<pre>";
            print_r($data);
            die();
            $copCount = Coupon::where('coupon_code', $data['code'])->count();
            if ($copCount == 0) {
                return response()->json([
                    'status' => false, 'message' => "this coupon is not valid",
                    'view' => (string)View::make('user.cart_item')]);
            }

        }
    }

    public function applyCoupon(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            //echo "<pre>";print_r($data);die();
            $copCount = Coupon::where('coupon_code', $data['code'])->count();
            $userCart = Cart::userCart();
            $totalCartItems = totalCartItems();
            if ($copCount == 0) {
                return response()->json([
                    'status' => false, 'message' => "this coupon code is not valid", 'totalCartItems' => $totalCartItems,
                    'view' => (string)View::make('user.cart_item')->with(compact('userCart'))]);
            } else {
                $copDetails = Coupon::where('coupon_code', $data['code'])->first();
                if ($copDetails->status == 0) {
                    $msg = "this coupon code is not active";
                }
                if ($copDetails->expire_date < date('Y-m-d')) {
                    $msg = "this coupon code is Expired ";
                }
                $cats = explode(",", $copDetails->categories);
                // $userCart=Cart::userCart();
                //echo "<pre>";print_r($userCart);die();
                foreach ($userCart as $key => $item) {
                    if (!in_array($item['product']['category_id'], $cats)) {
                        $msg = "this coupon code is not for this product ";
                    }
                }
                $users = explode(",", $copDetails->users);
                foreach ($users as $key => $user) {
                    $getID = User::select('id')->where('email', $user)->first()->toArray();
                    $userID[] = $getID['id'];
                }
                $totalAmount = 0;
                foreach ($userCart as $key => $item) {
                    if (!in_array($item['user_id'], $userID)) {
                        $msg = "this coupon code is not for you ";
                    }
                    $attrPrice = Product::attrDiscount($item['product_id'], $item['size']);
                    $totalAmount = $totalAmount + ($attrPrice['discounted_price'] * $item['quantity']);
                }
                // echo $totalAmount;die();
                if (isset($msg)) {
                    return response()->json([
                        'status' => false, 'message' => $msg, 'totalCartItems' => $totalCartItems,
                        'view' => (string)View::make('user.cart_item')->with(compact('userCart'))]);
                } else {
                    if ($copDetails->amount_type == "fixed") {
                        $copAmount = $copDetails->amount;
                    } else {
                        $copAmount = $totalAmount * ($copDetails->amount / 100);
                    }
                    $grand = $totalAmount + $copAmount;

                    Session::put('copAmount',$copAmount);
                    Session::put('copCode',$data['code']);
                    $msg = "Coupon code Applied Successfully";
                    return response()->json([
                        'status' => false, 'message' => $msg, 'totalCartItems' => $totalCartItems, 'grand' => $grand, 'cop' => $copAmount,
                        'view' => (string)View::make('user.cart_item')->with(compact('userCart'))]);
                }

            }
        }
    }

    public function checkOut(Request $request)
    {
        $userCart = Cart::userCart();
        $deliveryAddress = DeliveryAddress::deliveryAddress();
        if($request->isMethod('post')){
            $data=$request->all();
            if(empty($data['pay_gateway'])){
                $msg="missing p";
                Session::flash('fail',$msg);
                return redirect()->back();
            }
            if(empty($data['key_id'])){
                $msg="missing k";
                Session::flash('fail',$msg);
                return redirect()->back();
            }

           // echo Session::get('grand_total');
            //print_r($data);die();
            if($data['pay_gateway']=="cod"){
                $pay_method="cod";
            }else{

                $pay_method="prepaid";
                echo"comming soon";die();
            }

            $d_address=DeliveryAddress::where('id',$data['key_id'])->first()->toArray();
            $user_id=Auth::user()->id;
           //dd($user_id);
            DB::beginTransaction();
            $order= new Order();
            $order->user_id = $user_id;
            $order->name=$d_address['name'];
            $order->address=$d_address['address'];
            $order->city=$d_address['city'];
            $order->country=$d_address['country'];
            $order->zipcode=$d_address['zipcode'];
            $order->mobile=$d_address['mobile'];
            $order->email=Auth::user()->email;
            $order->shipping_charges=0;
            $order->coupon_code=Session::get('couponCode');
            $order->coupon_amount=Session::get('couponAmount');
            $order->grand_total=Session::get('grand_total');
            $order->order_status="new";
            $order->pay_method=$pay_method;
            $order->pay_gateway=$data['pay_gateway'];
            $order->save();

            $order_id=DB::getPdo()->lastInsertID();
            Session::put('order_id',$order_id);
            $cartItems= Cart::where('user_id',Auth::user()->id)->get()->toArray();
            foreach ($cartItems as $key =>$item){
                $getpro=Product::select('product_name','product_code','product_color')
                    ->where('id',$item['product_id'])->first()->toArray();
                $getDis=Product::attrDiscount($item['product_id'],$item['size']);
                $cartItem= new OrderProduct();
                $cartItem->order_id=$order_id;
                $cartItem->user_id=Auth::user()->id;
                $cartItem->product_id=$item['product_id'];
                $cartItem->product_code=$getpro['product_code'];
                $cartItem->product_color=$getpro['product_color'];
                $cartItem->product_name=$getpro['product_name'];
                $cartItem->product_size=$item['size'];
                $cartItem->product_price=$getDis['discounted_price'];
                $cartItem->product_quantity=$item['quantity'];
                $cartItem->save();

            }
            DB::commit();
            if($data['pay_gateway']=="cod"){
                $message="dear ".$order_id." successfully placed";
                $details=Order::with('orders_products')->where('id',$order_id)->first()->toArray();
                $email=Auth::user()->email;
                $name=Auth::user()->name;
                $messageData=['name'=>$name,'order_id'=>$order_id,'details'=>$details,'email'=>$email];
                Mail::send('emails.order',$messageData,function ($message) use($email){
                    $message->to($email)->subject('Welcome to Becha Kena Bazar');
                });
               return redirect('/thanks');
            }else{
                echo"comming soon";
            }
        }
        return view('user.check_out')->with(compact('deliveryAddress', 'userCart'));
    }

    public function thanks(){
        if(Session::has('order_id')){
            Cart::where('user_id',Auth::user()->id)->delete();
            return view('user.thanks');
      }else{
            return redirect('/cart');
        }
    }

    public function addDelivery(Request $request, $id = null)
    {
        if ($request->id == "") {
            $title = "Add";
            $address = array();
            $add = new DeliveryAddress();
        } else {
            $title = "Edit";
            $add = DeliveryAddress::find($id);
            $address = DeliveryAddress::where('id', $id)->first();
            $address = json_decode(json_encode($address), true);
           // echo "<pre>";print_r($address);die();
        }
        if ($request->isMethod('post')) {
            $data = $request->all();
            //echo "<pre>";print_r($data);die();
            $add->user_id=Auth::user()->id;
            $add->name = $data['name'];
            $add->address = $data['address'];
            $add->country = $data['country'];
            $add->city = $data['city'];
            $add->mobile = $data['mobile'];
            $add->save();
            Session::flash('success', 'data recorded success');
            return redirect('/check-out');

        }
        return view('user.delivery')->with(compact('title', 'address'));
    }

    public function delDelivery($id){
        DeliveryAddress::where('id',$id)->delete();
        Session::flash('success', 'data delete success');
        return redirect()->back();
    }
}
