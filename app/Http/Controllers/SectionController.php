<?php

namespace App\Http\Controllers;

use App\Models\Section;
use Illuminate\Http\Request;
use Session;

class SectionController extends Controller
{
    public function section(){
        Session::put('page','sections');
        $sections= Section::get();
        return view('admin.section.section')->with(compact('sections'));
    }
    public function checkSection (Request $request){
        if($request->ajax()){
            $data=$request->all();
            //echo "<pre>";print_r($data);die;
            if($data['status']=="Active"){
                $status=0;
            }else{
                $status=1;
            }
            Section::where('id',$data['check_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'check_id'=>$data['check_id']]);
        }
    }
}
