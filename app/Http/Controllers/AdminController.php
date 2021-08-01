<?php

namespace App\Http\Controllers;



use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Session;
use Image;



class AdminController extends Controller
{
    public function index (){
        Session::put('page','dashboard');
        return view('admin.admin_dashboard');
    }

    public function settings(){
        Session::put('page','settings');
        $adminDetails=Admin::where('id',Auth::guard('admin')->user()->id)->first();
        return view('admin.admin_settings')->with(compact('adminDetails'));
    }

    public function login(Request $req){
        if($req->isMethod('post')){
            $data= $req->all();
            $rules=[
                'email' => 'required|email|max:255',
                'password' => 'required',
            ];
            $customMessages=[
                'email.required'=>'email de',
                'password.required'=>'pass de',
            ];
            $this->validate($req,$rules,$customMessages);

         //   echo "<pre>";print_r($data);die();
            if(Auth::guard('admin')->attempt(['email'=>$data['email'],'password'=>$data['password']])){
                //   echo "<pre>";print_r($data);die();
                return redirect('admin/dashboard');
            }else{
                Session::flash('fail','kon bal disos');
                return redirect()->back();
            }
        }
        return view('admin.admin_login');
    }

    public function logOut(){
        Auth::guard('admin')->logout();
        Session::flash('success','SuccessFully Logout');
        return redirect('/admin');
    }

    public function checkPwd(Request $request){
        $data=$request->all();
       // echo Auth::guard('admin')->user()->password;die();
        //echo "<pre>";print_r($data);die();
        if(Hash::check($data['current_pwd'],Auth::guard('admin')->user()->password)){
            echo true;
        }else{
            echo false;
        }
    }



    public function updatePwd(Request $request){

        if ($request->isMethod('post')){
            $data=$request->all();
           // echo "<pre>";print_r($data);die();
            if(Hash::check($data['current_pwd'],Auth::guard('admin')->user()->password)){
                //echo "<pre>";print_r($data);die();
                if($data['new_pwd']==$data['confirm_pwd']){
                    //echo "<pre>";print_r($data);die();
                    Admin::where('id',Auth::guard('admin')->user()->id)->update(['password'=>bcrypt($data['new_pwd'])]);
                    Session::flash('success','kon bal disos');
                    return redirect()->back();
                }else{
                    Session::flash('fail','kon bal disos');
                    return redirect()->back();
                }

            }else{
                Session::flash('fail','kon bal disos');
                return redirect()->back();
            }
        }
    }


    public function checkConfirmPwd(Request $request){

        $data=$request->all();
       // echo "<pre>";print_r($data);die();
        if($data['new_pwd']==$data['confirm_pwd']){
            echo true;
        }else{
            echo false;
        }
    }
    public function updateAdmin (Request $request){
        Session::put('page','updateAdmin');
        if ($request->isMethod('post')){
            $data=$request->all();
             //echo "<pre>";print_r($data);die();
            $rules=[
                //'adminName' => 'required|alpha|max:255',
                'mobile' => 'numeric',
                'image' => 'mimes:jpeg,jpg,png',
            ];
            $customMessages=[
                'adminName.required'=>'email de',
                //'adminName.alpha'=>'pass de',
                //'mobile.required'=>'mob de',
                'mobile.numeric'=>'number de',
                'image.mimes'=>'valo pic de'
            ];
            $this->validate($request,$rules,$customMessages);

           if($request->hasFile('image')){
                $image_tmp=$request->file('image');
                if ($image_tmp->isValid()){
                    $extension= $image_tmp->getClientOriginalExtension();
                    $image_name=rand(111,9999).".".$extension;
                    $image_path='images/admin/'.$image_name;
                   Image::make($image_tmp)->save($image_path);
                }
            }else if(empty($data['current_img'])){
               $image_name=$data['current_img'];
           }
           else {
               $image_name="";
           }



            Admin::where('id',Auth::guard('admin')->user()->id)->update(['name'=>$data['adminName'],'mobile'=>$data['mobile'],'image'=>$image_name]);
            Session::flash('success','kon bal disos');
            return redirect()->back();

        }
        $adminDetails=Admin::where('id',Auth::guard('admin')->user()->id)->first();
        return view('admin.update_admin')->with(compact('adminDetails'));

    }

}
