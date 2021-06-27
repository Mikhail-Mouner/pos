<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $products=[
            [
                'category_id' => 1,
                'ar'=> ['name'=>'product 0','description'=>'description'],
                'en'=> ['name'=>'product 0','description'=>'description'],
                'purchase_price' => 20,
                'sale_price' => 25,
                'stock' => 10,
            ],
            [
                'category_id' => 1,
                'ar'=> ['name'=>'product 1','description'=>'description'],
                'en'=> ['name'=>'product 1','description'=>'description'],
                'purchase_price' => 30,
                'sale_price' => 80,
                'stock' => 17,
            ],
            [
                'category_id' => 2,
                'ar'=> ['name'=>'product 2','description'=>'description'],
                'en'=> ['name'=>'product 2','description'=>'description'],
                'purchase_price' => 23,
                'sale_price' => 40,
                'stock' => 20,
            ],
            [
                'category_id' => 3,
                'ar'=> ['name'=>'product 3','description'=>'description'],
                'en'=> ['name'=>'product 3','description'=>'description'],
                'purchase_price' => 55,
                'sale_price' => 75,
                'stock' => 9,
            ],
        ];

        foreach ($products as $product){

            Product::create($product);
        }
    }
}
