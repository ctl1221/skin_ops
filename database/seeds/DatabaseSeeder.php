<?php

use Illuminate\Database\Seeder;

use App\Branch;
use App\PaymentType;
use App\Sequence;
use App\SkinProSlack;

class DatabaseSeeder extends Seeder
{
    public function run()
    {

        $this->call(UsersSeeder::class);
        $this->call(PricelistsSeeder::class);

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

        //$this->call(ItemsSeeder::class);
        $this->call(RealDataSeeder::class);
        $this->call(RealData2Seeder::class);
        factory(App\Client::class, 50)->create();

        PaymentType::create([
            'name' => 'Promotions',
            'is_subtractable' => 1,
        ]);

        PaymentType::create([
            'name' => 'Discount',
            'is_subtractable' => 1,
        ]);

        PaymentType::create([
            'name' => 'Cash',
            'is_direct' => 1,
        ]);

        PaymentType::create([
            'name' => 'Card',
            'is_direct' => 1,
        ]);

        PaymentType::create([
            'name' => 'Cash GC',
            'is_subtractable' => 1,
        ]);

        PaymentType::create([
            'name' => 'Freebies GC',
            'is_subtractable' => 1,
        ]);

        Sequence::create([
            'name' => 'SO Number',
            'description' => 'Sales Order Number',
            'prefix' => 'SO',
            'integer_value' => 10001,
            'decimal_value' => 10001,
            'text_value' => '10001'
        ]);

        Sequence::create([
            'name' => 'DT Number',
            'description' => 'Draft Number',
            'prefix' => 'DT',
            'integer_value' => 10001,
            'decimal_value' => 10001,
            'text_value' => '10001'
        ]);

        SkinProSlack::create();

    }
}
