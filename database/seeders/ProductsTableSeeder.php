<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $proRecords=[
        [
            'id'=>1,
            'category_id'=>2,
            'section_id'=>1,
            'product_name'=>'test',
            'product_color'=>'red',
            'product_code'=>'test',
            'product_price'=>100,
            'product_discount'=>10,
            'product_weight'=>50,
            'description'=>'',
            'product_video'=>'',
            'main_image'=>'',
            'wash_care'=>'',
            'fabric'=>'',
            'pattern'=>'',
            'sleeve'=>'',
            'fit'=>'',
            'occasion'=>'',
            'meta_title'=>'',
            'meta_description'=>'',
            'meta_keywords'=>'',
            'is_featured'=>'no',
            'status'=>1
        ],
        [
            'id'=>2,
            'category_id'=>1,
            'section_id'=>1,
            'product_name'=>'test',
            'product_color'=>'red',
            'product_code'=>'test',
            'product_price'=>100,
            'product_discount'=>10,
            'product_weight'=>50,
            'description'=>'',
            'product_video'=>'',
            'main_image'=>'',
            'wash_care'=>'',
            'fabric'=>'',
            'pattern'=>'',
            'sleeve'=>'',
            'fit'=>'',
            'occasion'=>'',
            'meta_title'=>'',
            'meta_description'=>'',
            'meta_keywords'=>'',
            'is_featured'=>'No',
            'status'=>1
        ]
    ];
        Product::insert($proRecords);

    }
}
