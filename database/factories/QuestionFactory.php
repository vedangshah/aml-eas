<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use App\Models\Exam;
use App\Models\Question;
use Faker\Generator as Faker;
use Illuminate\Support\Str;


$factory->define(Question::class, function (Faker $faker) {
    return [
        'exam_id' => $faker->randomDigit,
        'description' => $faker->sentence,
        'difficulty_levels_id' => $faker->randomDigit,
    ];
});
