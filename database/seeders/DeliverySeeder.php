<?php

namespace Database\Seeders;

use App\Models\DeliveryAddress;
use Illuminate\Database\Seeder;

class DeliverySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rec=[
            [ 'id'=>1,'user_id'=>'1','name'=>'test'],
        ];
        DeliveryAddress::insert($rec);
    }
}
