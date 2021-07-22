<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    $password = Hash::make('123123');
    $name = $faker->firstName;
    $lastname = $faker->lastname;
    return [
        'name' => $name,
        'lastname' => $lastname,
        'email' => strtolower("$name.$lastname@epn.edu.ec"),
        'email_verified_at' => now(),
        'password' => $password,
        'phone' => $faker->phoneNumber,
        'sex' => $faker->randomElement(['male', 'female']),
        'status' => 'active'
    ];
});
