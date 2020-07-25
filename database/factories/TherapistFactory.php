<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Therapist;
use Faker\Generator as Faker;

$factory->define(Therapist::class, function (Faker $faker) {
    return [
        'title' => $faker->name,
        'picture' => rand(1,9).'.png',
        'description'=> $faker->paragraph,
        'price' => rand(150,350),
        'active' => true,
    ];
});
