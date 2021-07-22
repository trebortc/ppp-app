<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\RecommendedTopic;
use Faker\Generator as Faker;

$factory->define(RecommendedTopic::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(),
    ];
});
