<?php

use Illuminate\Database\Seeder;
use App\SalesOrder;
use App\SalesOrderLine;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call(UsersSeeder::class);
        $this->call(PricelistsSeeder::class);
        $this->call(ItemsSeeder::class);
        factory(App\Client::class, 50)->create();
    }
}
