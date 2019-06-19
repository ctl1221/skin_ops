<?php

use Illuminate\Database\Seeder;
use App\PaymentType;

class PaymentTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
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

        PaymentType::create([
            'name' => 'Owner Price Waived',
            'is_subtractable' => 1,
        ]);
    }
}
