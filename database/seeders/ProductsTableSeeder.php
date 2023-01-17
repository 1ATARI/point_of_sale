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
        $products = ['pro one', 'pro two'];

        foreach ($products as $product) {

            Product::create([
                'category_id' => 1,
                'name'=>['ar'=>$product.' ar' , 'en'=>$product .' en'],
                'description'=>['ar'=>$product.' disc ar' , 'en'=>$product .' disc en'],
                'purchase_price' => 100,
                'sale_price' => 150,
                'stock' => 100,
            ]);

        }//end of foreach
    }
}
