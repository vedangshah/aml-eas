<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'date_of_birth' => $faker->dateTimeThisCentury->format('Y-m-d'),
        'password' => Hash::make('la'), // password
        'address' => $faker->streetAddress,
        'contact_no' => $faker->phoneNumber,
        'company_name' => $faker->company,
        'profile_picture' => $faker->company, // to be changed
    ];
});
