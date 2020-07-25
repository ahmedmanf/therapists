<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Reservation;
use Faker\Generator as Faker;

$factory->define(Reservation::class, function (Faker $faker) {
    return [
        'therapist_id' => factory(App\Therapist::class),
        'time' => $faker->dateTime,
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'mobile' => $faker->phoneNumber
    ];
});
