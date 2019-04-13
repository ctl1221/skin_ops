<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductsSeeder extends Seeder
{
    public function run()
    {
        Product::create([
    		'name' => 'Collagen Candy',
    	]);

    	Product::create([
    		'name' => 'Whiteplus Cream',
    	]);
    }
}
