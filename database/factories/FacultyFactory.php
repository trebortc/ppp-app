<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Faculty;
use Faker\Generator as Faker;

$factory->define(Faculty::class, function (Faker $faker) {
    return [
        'name' => $faker->company,
        'status' => 'active'
    ];
});
