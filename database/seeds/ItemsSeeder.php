<?php

use Illuminate\Database\Seeder;
use App\Product;
use App\Service;
use App\Package;
use App\Pricelist;
use App\PricelistSellable;
use App\PackageBreakdown;

class ItemsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $number_of_products = 10;
        $number_of_services = 50;
        $number_of_packages = 9;


        factory(Product::class, $number_of_products)->create()->each(function ($product) {
            $pricelists = Pricelist::all();
            foreach($pricelists as $x)
            {
                PricelistSellable::create([
                    'pricelist_id' => $x->id,
                    'sellable_type' => 'App\Product',
                    'sellable_id' => $product->id,
                    'price' => rand(500,5000),
                ]);
            }
        });

        factory(Service::class, $number_of_services)->create()->each(function ($service) {
            $pricelists = Pricelist::all();
            foreach($pricelists as $x)
            {
                PricelistSellable::create([
                    'pricelist_id' => $x->id,
                    'sellable_type' => 'App\Service',
                    'sellable_id' => $service->id,
                    'price' => rand(1200,8000),
                ]);
            }
        });

        factory(Package::class, $number_of_packages)->create()->each(function ($package, $number_of_services) {
            $pricelists = Pricelist::all();
            foreach($pricelists as $x)
            {
                PricelistSellable::create([
                    'pricelist_id' => $x->id,
                    'sellable_type' => 'App\Package',
                    'sellable_id' => $package->id,
                    'price' => rand(15000,40000),
                ]);
            }

            PackageBreakdown::create([
                'package_id' => $package->id,
                'sellable_id' => rand(7, $number_of_services),
                'sellable_type' => 'App\Service',
                'quantity' => rand(11,20),
            ]);

            PackageBreakdown::create([
                'package_id' => $package->id,
                'sellable_id' => rand(6, 9),
                'sellable_type' => 'App\Service',
                'quantity' => rand(4,6),
            ]);

            PackageBreakdown::create([
                'package_id' => $package->id,
                'sellable_id' => rand(1, 4),
                'sellable_type' => 'App\Service',
                'quantity' => rand(1,3),
            ]);
        });
    }
}
