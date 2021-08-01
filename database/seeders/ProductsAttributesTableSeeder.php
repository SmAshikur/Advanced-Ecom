<?php

namespace Database\Seeders;

use App\Models\ProductsAttribute;
use Illuminate\Database\Seeder;

class ProductsAttributesTableSeeder extends Seeder
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
                'id'=>1,
                'product_id'=>9,
                'size'=>'small',
                'price'=>1000,
                'stock'=>50,
                'sku'=>'tests',
                'status'=>1
            ],
            [
            'id'=>2,
            'product_id'=>9,
            'size'=>'medium',
            'price'=>1200,
            'stock'=>50,
            'sku'=>'testm',
            'status'=>1
        ],
            [
                'id'=>3,
                'product_id'=>9,
                'size'=>'large',
                'price'=>1500,
                'stock'=>50,
                'sku'=>'testl',
                'status'=>1
            ]
        ];
        ProductsAttribute::insert($records);
    }
}
