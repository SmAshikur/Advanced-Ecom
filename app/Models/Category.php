<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\CategoryController;


class Category extends Model
{

    public function subcategories(){
        return $this->hasMany('App\Models\Category','parent_id')->where('status',1);
    }
    public function section(){
        return $this->belongsTo('App\Models\Section','section_id')->select('id','name');
    }
    public function category(){
        return $this->belongsTo('App\Models\Category','parent_id')->select('id','category_name');
    }
    public static function catDetails ($url){
          $catDetails=Category::select('id','parent_id','category_name','url','description')->with(['subcategories' =>function($query){
            $query->select('id','parent_id','description')->where('status',1);
        }])->where('url',$url)->first()->toArray();
         // dd($catDetails);
        if ($catDetails['parent_id']==0){
        $breads='<a href="'.url($catDetails['url']).'">'.$catDetails['category_name'].'</a>';
        }else{
        $parentCat = Category::select('category_name','url')->where('id',$catDetails['parent_id'])->first()->toArray();
            $breads='<a href="'.url($parentCat['url']).'">'.$parentCat['category_name'].'</a>'.'<span class="divider">/</span>'.
                '<a href="'.url($catDetails['url']).'">'.$catDetails['category_name'].'</a>';
        }
        $catIds=array();
        $catIds[]=$catDetails['id'];
        foreach ($catDetails['subcategories'] as $key=> $subcat){
            $catIds[]=$subcat['id'];
        }
        //dd($catIds);
        return array('catIds'=>$catIds,'catDetails'=>$catDetails,'breads'=>$breads);
    }

}
