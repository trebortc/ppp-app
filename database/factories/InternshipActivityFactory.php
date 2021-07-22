<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\RecommendedTopic;
use Faker\Generator as Faker;

$factory->define(\App\InternshipActivity::class, function (Faker $faker) {
    return [
        'description' => $faker->paragraph,
    ];
});
