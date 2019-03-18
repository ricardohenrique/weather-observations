<?php

use Faker\Generator as Faker;
use App\Models\ObservationModel;

$factory->define(ObservationModel::class, function (Faker $faker) {
    return [
        'timestamp'   => $faker->dateTime(),
        'location' 	  => $faker->randomNumber().','.$faker->randomNumber(),
        'temperature' => $faker->numberBetween(-50, 50),
        'observatory' => $faker->randomElement(['AU','US','FR', strtoupper(Str::random(2))])
    ];
});
