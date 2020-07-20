<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\OrderUser::class, function (Faker $faker) {
    return [
        'reference' => $faker->randomNumber(10),
        'pagseguro_code' => $faker->randomNumber(10),
        'pagseguro_status' => $faker->randomNumber(1)
    ];
});
