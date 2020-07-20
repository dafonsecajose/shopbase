<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\ItemOrder::class, function (Faker $faker) {
    return [
        'price' => $faker->randomFloat(2, 2, 10),
        'amount' => $faker->randomNumber(2)
    ];
});
