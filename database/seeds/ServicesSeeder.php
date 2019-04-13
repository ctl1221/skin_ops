<?php

use Illuminate\Database\Seeder;
use App\Service;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Service::create([
    		'name' => 'Basic Facial',
    	]);

    	Service::create([
    		'name' => 'Diamond Peel', 
    	]);
    }
}
