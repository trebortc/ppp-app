<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Career;
use Faker\Generator as Faker;

$factory->define(Career::class, function (Faker $faker) {
    $faculties = \App\Faculty::all();
    return [
        'name' => $faker->jobTitle,
        'pensum' => $faker->year,
        'levels' => $faker->numberBetween(5,6),
        'status' => 'active',
//        'faculty_id' => $faker->randomElement($faculties)
    ];
});
