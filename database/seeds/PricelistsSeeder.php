<?php

use Illuminate\Database\Seeder;
use App\Pricelist;
use App\PricelistSellable;

class PricelistsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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
    }
}
