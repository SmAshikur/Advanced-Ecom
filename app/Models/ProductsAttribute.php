<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsAttribute extends Model
{
    public function product(){
        return $this->belongsTo('App\Models\Product','product_id') ->select('id','product_name');
    }
}
