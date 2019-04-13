<?php

use Faker\Generator as Faker;

$factory->define(App\Client::class, function (Faker $faker) {
    return [
         'last_name' => $faker->lastName,
         'first_name' => $faker->firstName,
         'pricelist_id' => $faker->numberBetween(1,4),
         'is_active' => $faker->numberBetween(0,1),
    ];
});
