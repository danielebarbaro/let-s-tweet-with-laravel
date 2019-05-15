<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Faker\Generator as Faker;

$factory->define(App\Models\Tweet::class, function (Faker $faker) {
    return [
        'user_id' => App\Models\User::pluck('id')->random(),
        'body' => $faker->text(120),
        'created_at' => $faker->dateTimeBetween('-2 months'),
    ];
});
