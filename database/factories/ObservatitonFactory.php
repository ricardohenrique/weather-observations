<?php

use Faker\Generator as Faker;
use App\Models\ObservationModel;

$factory->define(ObservationModel::class, function (Faker $faker) {
    return [
        'timestamp'   => $faker->dateTime()->format('Y-m-d H:i:s'),
        'location' 	  => $faker->randomNumber().','.$faker->randomNumber(),
        'temperature' => $faker->numberBetween(-50, 50),
        'observatory' => $faker->randomElement(['AU','US','FR', chr(rand(65,90)) . chr(rand(65,90))])
    ];
});
