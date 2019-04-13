<?php

use Faker\Generator as Faker;

$factory->define(App\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->numerify('Product ###'),
        'is_active' => $faker->numberBetween(0,1),
    ];
});
