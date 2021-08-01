<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index (){
        $pageName="index";
        $featureCount=Product::where('is_featured','yes')->where('status',1)->count();
        $featureItems =Product::with('category')->where('is_featured','yes')->where('status',1)->get()->toArray();
       // dd($featureItems);
        $featureItemsChunk=array_chunk($featureItems,4);

        $newPro=Product::orderBy('id','Desc')->where('status',1)->get()->toArray();
       //dd($featureItemsChunk);
        return view('user.index')->with(compact('pageName','featureItemsChunk','featureCount','newPro'));
    }
}
