<?php

namespace App\Http\Controllers;

use App\Models\ShippingCharge;
use Illuminate\Http\Request;

class ShippingChargeController extends Controller
{
    public function shipping(){
        $charges=ShippingCharge::get()->toArray();
         return view('admin.order.shipping')->with(compact('charges'));

    }
}
