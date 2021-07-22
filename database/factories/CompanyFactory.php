<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Company;
use Faker\Generator as Faker;

$factory->define(Company::class, function (Faker $faker) {

    $administratives = \App\Administrative::all();

    return [
        'authorized_by' => $faker->randomElement($administratives),
        'ruc' => $faker->numerify('##########'),
        'name' => $faker->company,
        'type' => $faker->randomElement(['pública', 'privada', 'organismo internacional', 'tercer sector', 'otras']),
        'address' => $faker->address,
        'phone' => $faker->phoneNumber,
        'mobile'=> $faker->phoneNumber,
        'email' => $faker->companyEmail,
        'city' => 'Quito'
    ];
});
