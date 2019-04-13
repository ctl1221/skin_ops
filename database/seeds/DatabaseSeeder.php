<?php

use Illuminate\Database\Seeder;
use App\Product;
use App\Service;
use App\Client;
use App\Pricelist;
use App\PricelistSellable;
use App\SalesOrder;
use App\SalesOrderLine;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersSeeder::class);

    	Product::create([
    		'name' => 'Collagen Candy',
    	]);

    	Product::create([
    		'name' => 'Whiteplus Cream',
    	]);

    	Service::create([
    		'name' => 'Basic Facial',
    	]);

    	Service::create([
    		'name' => 'Diamond Peel', 
    	]);

        Client::create([
            'last_name' => 'Licup',
            'first_name' => 'Charles',
            'is_active' => 1,
        ]);

        Client::create([
            'last_name' => 'Stark',
            'first_name' => 'Tony',
            'is_active' => 1,
        ]);

        Client::create([
            'last_name' => 'Jones',
            'first_name' => 'Davy',
            'is_active' => 0,
        ]);

        Client::create([
            'last_name' => 'Sparrow',
            'first_name' => 'Jack',
            'is_active' => 0,
        ]);

        Pricelist::create([
            'name' => 'Regular',
        ]);

        Pricelist::create([
            'name' => 'Member',
        ]);

        Pricelist::create([
            'name' => 'Employee',
        ]);

        Pricelist::create([
            'name' => 'Owner',
        ]);

        PricelistSellable::create([
            'pricelist_id' => 1,
            'sellable_id' => 1,
            'sellable_type' => 'App\\Product',
            'price' => 700
        ]);

        PricelistSellable::create([
            'pricelist_id' => 1,
            'sellable_id' => 2,
            'sellable_type' => 'App\\Product',
            'price' => 1000
        ]);

        PricelistSellable::create([
            'pricelist_id' => 1,
            'sellable_id' => 1,
            'sellable_type' => 'App\\Service',
            'price' => 900
        ]);

        PricelistSellable::create([
            'pricelist_id' => 1,
            'sellable_id' => 2,
            'sellable_type' => 'App\\Service',
            'price' => 1400
        ]);

         PricelistSellable::create([
            'pricelist_id' => 2,
            'sellable_id' => 1,
            'sellable_type' => 'App\\Product',
            'price' => 600
        ]);

        PricelistSellable::create([
            'pricelist_id' => 3,
            'sellable_id' => 1,
            'sellable_type' => 'App\\Product',
            'price' => 550
        ]);

        PricelistSellable::create([
            'pricelist_id' => 4,
            'sellable_id' => 1,
            'sellable_type' => 'App\\Product',
            'price' => 540
        ]);
    }
}
