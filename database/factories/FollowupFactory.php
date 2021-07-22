<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Followup;
use Faker\Generator as Faker;

$factory->define(Followup::class, function (Faker $faker) {
    return [
        'text' => $faker->paragraph,
        'type' => $faker->randomElement(['followup', 'compliment', 'complaint'])
    ];
});
