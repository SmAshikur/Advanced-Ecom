<?php
use App\Models\Category;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\SectionController;
use \App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminOrderController;
use \App\Http\Controllers\ShippingChargeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



//Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::prefix('admin')->namespace('Admin')-> group(function () {

    Route::match(['get', 'post'],'/',[AdminController::class,'login'] );

    Route::group(['middleware'=>['admin']],function (){
        Route::get('dashboard',[AdminController::class,'index']);
        Route::get('settings',[AdminController::class,'settings']);
        Route::get('logout',[AdminController::class,'logOut']);
        Route::post('/check-pwd',[AdminController::class,'checkPwd']);
        Route::post('/check-confirm-pwd',[AdminController::class,'checkConfirmPwd']);
        Route::post('/update-pwd',[AdminController::class,'updatePwd']);
        Route::match(['get', 'post'],'/update-admin',[AdminController::class,'updateAdmin'] );

        //status-check
        Route::post('/status-section',[SectionController::class,'checkSection']);
        //section
        Route::get('sections',[SectionController::class,'section']);
        //status-check
        Route::post('/status-brand',[BrandController::class,'checkBrand']);
        //Brand
        Route::get('brands',[BrandController::class,'brand']);
        Route::match(['get','post'],'add-edit-brand/{id?}',[BrandController::class,'addBrand']);
        Route::get('del-brand/{id}',[BrandController::class,'delBrand']);
        //section


        //category
        Route::get('category',[CategoryController::class,'category']);
        Route::match(['get', 'post'],'/add-category/{id?}',[CategoryController::class,'addCat'] );
        Route::get('del-cat/{id}',[CategoryController::class,'delCat']);
        //append-check
        Route::post('/append-cat',[CategoryController::class,'appendCheck']);
        //del-img
        Route::get('del-img/{id}',[CategoryController::class,'delImg']);
        //status-check
        Route::post('/status-category',[CategoryController::class,'checkCategory']);

        //products
        Route::get('products',[ProductController::class,'products']);
        Route::match(['get', 'post'],'/add-product/{id?}',[ProductController::class,'addPro'] );
        Route::get('del-pro/{id}',[ProductController::class,'delPro']);
        //del-img
        Route::get('del-pro-img/{id}',[ProductController::class,'delPImg']);
        Route::get('del-video/{id}',[ProductController::class,'delPVideo']);
        //status-check pro
        Route::post('/status-product',[ProductController::class,'checkProduct']);


        //products

        Route::match(['get', 'post'],'/add-pAttr/{id}',[ProductController::class,'addAttr'] );
        Route::post('/edit-pAttr/{id}',[ProductController::class,'editAttr'] );
        Route::get('del-attr/{id}',[ProductController::class,'delAttr']);
        //status-check pro
        Route::post('/status-product-attr',[ProductController::class,'checkPro']);


        Route::match(['get', 'post'],'/add-attrImg/{id}',[ProductController::class,'addAttrImg'] );
        Route::get('del-attrImg/{id}',[ProductController::class,'delAttrImg']);
        //status-check pro
        Route::post('/status-product-img',[ProductController::class,'checkProductImg']);


        Route::get('/banner',[BannerController::class,'banner']);
        Route::post('/status-banner',[BannerController::class,'checkBanner']);
        Route::get('del-banner/{id}',[BannerController::class,'delBanner']);
        Route::match(['get', 'post'],'/add-banner/{id?}',[BannerController::class,'addBanner'] );
        Route::get('del-ban-img/{id}',[BannerController::class,'delBan']);

        Route::get('/coupon',[CouponController::class,'coupon']);
        Route::post('/status-coupon',[CouponController::class,'checkCoupon']);
        Route::get('del-coupon/{id}',[CouponController::class,'delCoupon']);
        Route::match(['get', 'post'],'/add-coupon/{id?}',[CouponController::class,'addCoupon'] );

        Route::get('/orders',[AdminOrderController::class,'orders']);
        Route::get('/orders-details/{id}',[AdminOrderController::class,'ordersDetails']);
        Route::get('/orders-invoice/{id}',[AdminOrderController::class,'ordersInvoice']);
        Route::post('/order-status',[AdminOrderController::class,'orderStatus']);

        Route::get('/shipping',[ShippingChargeController::class,'shipping']);
    });
});


Route::namespace('user')->group(function (){
        Route::get('/',[IndexController::class,'index']);
        $catUrl= Category::select('url')->where('status',1)->get()->pluck('url')->toArray();
        foreach ($catUrl as $url){
            Route::get('/'.$url,[ListingController::class,'listing']);
        }
        Route::get('/{product_name}/{product_code}/{id}',[ListingController::class,'proDetails']);
        Route::post('/change-price',[ListingController::class,'changePrice']);
        Route::post('/update-quantity',[ListingController::class,'changeQuantity']);
        Route::post('/delete-quantity',[ListingController::class,'deleteQuantity']);
        Route::post('/add-cart',[ListingController::class,'addCart']);
        Route::get('/cart',[ListingController::class,'cart']);
        Route::group(['namespace' => 'App\Http\Controllers', 'as' => 'login', ], function() {
                Route::get('/login-register',[UserController::class,'loginRegister']);
            });
        Route::post('/login',[UserController::class,'login']);
        Route::get('/logout',[UserController::class,'logout']);
        Route::post('/register',[UserController::class,'register']);
        Route::match(['get','post'],'check-email',[UserController::class,'checkEmail']);
        Route::match(['get','post'],'forgot-password',[UserController::class,'forgotPassword']);
        Route::group(['middleware'=>['auth']],function (){
            Route::get('/account',[UserController::class,'account']);
            Route::post('/update-account/{id}',[UserController::class,'updateAccount']);
            Route::post('/update-user-pwd',[UserController::class,'updateAccountPwd']);
            Route::post('/check-user-pwd',[UserController::class,'checkAccountPwd']);
            Route::post('/match-user-pwd',[UserController::class,'matchAccountPwd']);
            Route::post('/apply-coupon',[ListingController::class,'applyCoupon']);
            Route::match(['get','post'],'check-out',[ListingController::class,'checkOut']);
            Route::match(['get','post'],'add-delivery/{id?}',[ListingController::class,'addDelivery']);
            Route::get('/del-delivery/{id}',[ListingController::class,'delDelivery']);
            Route::get('/thanks',[ListingController::class,'thanks']);
            Route::get('/orders',[OrderController::class,'orders']);
            Route::get('/orders-details/{id}',[OrderController::class,'ordersDetails']);

            Route::match(['get','post'],'confirm/{code}',[UserController::class,'confirmAccount']);

        });

});
