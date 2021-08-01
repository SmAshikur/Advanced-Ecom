<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $rec=[
           [ 'id'=>1,'name'=>'test-1','status'=>1],
           [ 'id'=>2,'name'=>'test-2','status'=>1],
           [ 'id'=>3,'name'=>'test-3','status'=>1],
           [ 'id'=>4,'name'=>'test-5','status'=>1],
           [ 'id'=>5,'name'=>'test-6','status'=>1],
       ];
       Brand::insert($rec);
    }
}
