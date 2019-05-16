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
        $this->call(ItemsSeeder::class);
        //$this->call(RealDataSeeder::class);
        //$this->call(RealData2Seeder::class);
        factory(App\Client::class, 50)->create();

        Branch::create([
            'name' => 'Makati',
        ]);

        Branch::create([
            'name' => 'SM Mall of Asia',
        ]);

        Branch::create([
            'name' => 'Alabang Molito',
        ]);

        Branch::create([
            'name' => 'SM North Edsa',
        ]);

        PaymentType::create([
            'name' => 'Promotions',
        ]);

        PaymentType::create([
            'name' => 'Discount',
        ]);

        PaymentType::create([
            'name' => 'Cash',
        ]);

        PaymentType::create([
            'name' => 'Card',
        ]);

        PaymentType::create([
            'name' => 'Cash GC',
        ]);

        PaymentType::create([
            'name' => 'Freebies GC',
        ]);

    }
}
