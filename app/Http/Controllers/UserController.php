<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Session;
use Auth;

class UserController extends Controller
{
    public function loginRegister(){

        return view('user.login');
    }
    public function register(Request $req){
      if($req->isMethod('post')){
          $data=$req->all();
          //echo "<pre>";print_r($data);die();
          $user=User::where('email',$data['email'])->count();
          if($user>0){
              $message="fail";
              Session::flash('fail',$message);
              return redirect()->back();
          }else{
              User::insert(['name'=>$data['name'],'email'=>$data['email'],'password'=>bcrypt($data['password']),'mobile'=>$data['mobile']]);
              $message="success";

             if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password']])){
                 if(!empty(Session::get('session_id'))){
                     Cart::where('session_id',Session::get('session_id'))->update(['user_id'=>Auth::user()->id]);
                 }
                 Session::flash('fail',$message);
                 return redirect('/cart');
             }
          }

      }
        return view('user.login');
    }
    public function checkEmail(Request $request){

            $data=$request->all();
            $emailCount = User::where('email',$data['email'])->count();
            if($emailCount>0){
                return "false";
            }else{
                return "true";
            }

    }

    public function logout(){
        Auth::logout();
        Session::flash('success','SuccessFully Logout');
        return redirect()->back();
    }
    public function login(Request $req){
        if($req->isMethod('post')) {
            $data = $req->all();
            $message = "successfully login";
            if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
                if(!empty(Session::get('session_id'))){
                    Cart::where('session_id',Session::get('session_id'))->update(['user_id'=>Auth::user()->id]);
                }

                Session::flash('success', $message);
                return redirect('/cart');
            }else{
                $message = "can't login";
                Session::flash('fail',$message);
                return redirect()->back();
            }
        }
    }
    public function account(){
        $user=User::where('id',Auth::user()->id)->first()->toArray();
        //dd($user);
        return view('user.account')->with(compact('user'));
    }
    public function updateAccount(Request $request){
        if($request->isMethod('post')){
            $data=$request->all();
            //echo "<pre>"; print_r($data); die();
            $user = User::find(Auth::user()->id);
            $user->name= $data['name'];
            $user->address= $data['address'];
            $user->country= $data['country'];
            $user->city= $data['city'];
            $user->zipcode= $data['zipcode'];
            $user->email= $data['email'];
            $user->mobile= $data['mobile'];
            $user->save();
            Session::flash('success','Update Successfully');
            return redirect()->back();
        }
    }
    public function checkAccountPwd(Request $request){
        if($request->ajax()){
            $data=$request->all();
           //echo "<pre>"; print_r($data); die();
            if(Hash::check($data['current_pwd'],Auth::guard()->user()->password)){
                echo true;
            }else{
                echo false;
            }
        }
    }
    public function matchAccountPwd(Request $request){
        if($request->ajax()){
            $data=$request->all();
            //echo "<pre>"; print_r($data); die();
            if($data['new_pwd']==$data['confirm_pwd']) {
                echo true;
            }else{
                echo false;
            }
        }
    }
    public function updateAccountPwd(Request $request){
        if($request->isMethod('post')){
            $data=$request->all();
           // echo "<pre>"; print_r($data); die();
            if(Hash::check($data['current_pwd'],Auth::guard()->user()->password)){
                //echo "<pre>";print_r($data);die();
                if($data['new_pwd']==$data['confirm_pwd']){
                    //echo "<pre>";print_r($data);die();
                    User::where('id',Auth::guard()->user()->id)->update(['password'=>bcrypt($data['new_pwd'])]);
                    Session::flash('success','pass change');
                    return redirect()->back();
                }else{
                    Session::flash('fail','no matching');
                    return redirect()->back();
                }

            }else{
                Session::flash('fail','current pwd are wrong');
                return redirect()->back();
            }
        }
    }

}
