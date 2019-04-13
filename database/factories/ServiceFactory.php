<?php

use Faker\Generator as Faker;

$factory->define(App\Service::class, function (Faker $faker) {
    return [
        'name' => $faker->numerify('Service ####'),
       	'is_active' => $faker->numberBetween(0,1),
    ];
});
