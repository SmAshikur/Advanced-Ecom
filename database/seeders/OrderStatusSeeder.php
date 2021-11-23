<?php

namespace Database\Seeders;

use App\Models\OrderStatus;
use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        {
            $rec=[
                [ 'id'=>1,'name'=>'New','status'=>1],
                [ 'id'=>2,'name'=>'Pending','status'=>1 ],
                [ 'id'=>3,'name'=>'Hold','status'=>1],
                [ 'id'=>4,'name'=>'Canceled','status'=>1],
                [ 'id'=>5,'name'=>'In Process','status'=>1 ],
                [ 'id'=>6,'name'=>'paid','status'=>1],
                [ 'id'=>7,'name'=>'Shipped','status'=>1],
                [ 'id'=>8,'name'=>'Delivered','status'=>1 ],

            ];
            OrderStatus::insert($rec);
        }
    }
}
