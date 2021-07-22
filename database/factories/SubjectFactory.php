<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Subject;
use Faker\Generator as Faker;

$factory->define(Subject::class, function (Faker $faker) {
    $units = $faker->sentences(3);
    $fields = $faker->sentences(3);
    return [
        'name' => $faker->sentence(2),
        'code' => $faker->bothify('????####'),
        'level' => $faker->numberBetween(1, 6),
        'unit' => $faker->randomElement($units),
        'field' => $faker->randomElement($fields),
        'status' => 'active'
    ];
});
