<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
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
                [ 'id'=>1,'image'=>'1.png','title'=>'test'],
                [ 'id'=>2,'image'=>'2.png','title'=>'test'],
                [ 'id'=>3,'image'=>'3.png','title'=>'test'],
            ];
            Banner::insert($rec);
        }
    }
}
