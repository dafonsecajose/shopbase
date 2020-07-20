<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'resume' => $faker->sentence,
        'description' => $faker->paragraph(4, true),
        'price' => $faker->randomFloat(2, 2, 10),
        'height' => $faker->randomFloat(2, 2, 10),
        'width' => $faker->randomFloat(2, 2, 10),
        'weight' => $faker->randomFloat(2, 2, 10),
        'depth' => $faker->randomFloat(2, 2, 10),
        'amount' => $faker->randomNumber(3),
        'active' => 'OK'
    ];
});
