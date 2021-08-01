<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    public static function banner(){
        $getBanner= Banner::get()->where('status',1)->toArray();
       // dd($getBanner);die();
        return $getBanner;
    }
}
