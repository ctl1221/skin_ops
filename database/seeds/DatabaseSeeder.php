<?php

use Illuminate\Database\Seeder;

use App\Branch;
use App\PaymentType;
use App\Product;
use App\Sequence;
use App\SkinProSlack;
use App\Pricelist;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        SkinProSlack::create();

        Branch::create([
            'name' => 'Main Branch',
        ]);

        $this->call(UsersSeeder::class);
        $this->call(PaymentTypesSeeder::class);
        $this->call(SequencesSeeder::class);

        Pricelist::create([
            'name' => 'Regular',
        ]);

        Pricelist::create([
            'name' => 'Member',
        ]);

        Pricelist::create([
            'name' => 'Membership',
        ]);

        //$this->call(ItemsSeeder::class);
        //$this->call(RealDataSeeder::class);
        //$this->call(RealData2Seeder::class);
        //factory(App\Client::class, 50)->create();
    }
}
