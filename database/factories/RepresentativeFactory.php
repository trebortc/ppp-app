<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Company;
use Faker\Generator as Faker;

$factory->define(\App\Representative::class, function (Faker $faker) {
    return [
        'job_title' => $faker->jobTitle,
    ];
});
