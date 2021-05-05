<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Exam;
use Faker\Generator as Faker;


$factory->define(Exam::class, function (Faker $faker) {
    return [
        'user_id' => $faker->randomDigit,
        'name' => $faker->text,
        'max_questions' => $faker->randomDigit,
        'max_marks' => $faker->randomDigit,
        'start_date_time' =>$faker->dateTimeThisYear,
        'end_date_time' => Carbon\Carbon::now()->addMonths(5)->format('Y-m-d H:i:s'),

    ];
});
