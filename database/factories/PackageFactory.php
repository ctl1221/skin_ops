<?php

use Faker\Generator as Faker;

$factory->define(App\Package::class, function (Faker $faker) {
	return [
		'name' => $faker->numerify('Package ##'),
		'is_active' => $faker->numberBetween(0,1),
	];
});
