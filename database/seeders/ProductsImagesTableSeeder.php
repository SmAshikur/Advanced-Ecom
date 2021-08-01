<?php

namespace Database\Seeders;

use App\Models\ProductsImage;
use Illuminate\Database\Seeder;

class ProductsImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $records=[
            [
                'id'=> 1,
                'product_id'=>17,
                'image'=>'197232088_2924125614511610_3456877402939174187_n.j...',
                'status'=>0
            ]
        ];
        ProductsImage::insert($records);
    }
}
