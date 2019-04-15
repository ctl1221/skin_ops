<?php

use Illuminate\Database\Seeder;
use App\SalesOrder;
use App\SalesOrderLine;
use App\Employee;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(UsersSeeder::class);
        $this->call(PricelistsSeeder::class);
        $this->call(ItemsSeeder::class);
        factory(App\Client::class, 50)->create();

        Employee::create([
    		'last_name' => 'Grande',
    		'first_name' => 'Ariana',
    		'branch_id' => 1,
    	]);

    	Employee::create([
    		'last_name' => 'Obama',
    		'first_name' => 'Michelle',
    		'branch_id' => 2,
    	]);
    }
}
