<?php

use Illuminate\Database\Seeder;
use App\SalesOrder;
use App\SalesOrderLine;
use App\Employee;
use App\Branch;
use App\PaymentType;
use App\Membership;
use App\PricelistSellable;
use App\Product;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(UsersSeeder::class);
        $this->call(PricelistsSeeder::class);
        //$this->call(ItemsSeeder::class);
        $this->call(RealDataSeeder::class);
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

        Branch::create([
            'name' => 'SM Mall of Asia',
        ]);

        PaymentType::create([
            'name' => 'Cash',
        ]);

        PaymentType::create([
            'name' => 'Card',
        ]);

        Membership::create([
            'name' => 'Standard Membership',
            'days_valid' => 365,
        ]);

        Membership::create([
            'name' => 'Marina Membership',
            'days_valid' => 365,
        ]);

        PricelistSellable::create([
            'pricelist_id' => 1,
            'sellable_type' => 'App\Membership',
            'sellable_id' => 1,
            'price' => 1000,
        ]);

        PricelistSellable::create([
            'pricelist_id' => 2,
            'sellable_type' => 'App\Membership',
            'sellable_id' => 1,
            'price' => 1000,
        ]);

        PricelistSellable::create([
            'pricelist_id' => 3,
            'sellable_type' => 'App\Membership',
            'sellable_id' => 1,
            'price' => 1000,
        ]);

        PricelistSellable::create([
            'pricelist_id' => 4,
            'sellable_type' => 'App\Membership',
            'sellable_id' => 1,
            'price' => 1000,
        ]);

        PricelistSellable::create([
            'pricelist_id' => 1,
            'sellable_type' => 'App\Membership',
            'sellable_id' => 2,
            'price' => 1000,
        ]);

        PricelistSellable::create([
            'pricelist_id' => 2,
            'sellable_type' => 'App\Membership',
            'sellable_id' => 2,
            'price' => 1000,
        ]);

        PricelistSellable::create([
            'pricelist_id' => 3,
            'sellable_type' => 'App\Membership',
            'sellable_id' => 2,
            'price' => 1000,
        ]);

        PricelistSellable::create([
            'pricelist_id' => 4,
            'sellable_type' => 'App\Membership',
            'sellable_id' => 2,
            'price' => 1000,
        ]);

    }
}
