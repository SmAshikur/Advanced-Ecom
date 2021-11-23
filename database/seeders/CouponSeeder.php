<?php

namespace Database\Seeders;

use App\Models\Coupon;
use Illuminate\Database\Seeder;

class CouponSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rec=[
            [ 'id'=>1,'coupon_option'=>'png','coupon_code'=>'png','categories'=>'png','coupon_type'=>'png',
                'amount_type'=>'png','users'=>'png','amount'=>'png','expire_date'=>'1/5/6'
            ]
        ];
        Coupon::insert($rec);
    }
}
