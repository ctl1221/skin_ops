<?php

use Illuminate\Database\Seeder;
use App\SalesOrder;
use App\SalesOrderLine;
use App\Employee;
use App\Branch;

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
            'is_doctor' => 0,
            'is_receptionist' => 1,
            'is_aesthetician' => 0,
            'is_administrator' => 0,
    	]);

    	Employee::create([
    		'last_name' => 'Obama',
    		'first_name' => 'Michelle',
    		'branch_id' => 2,
            'is_doctor' => 0,
            'is_receptionist' => 0,
            'is_aesthetician' => 1,
            'is_administrator' => 0,
    	]);

        Branch::create([
            'name' => 'Makati',
        ]);
    }
}
