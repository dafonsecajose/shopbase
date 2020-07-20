<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Address::class, function (Faker $faker) {
    return [
        'street' => $faker->streetName,
        'neighborhood' => $faker->name ,
        'house_code' => $faker->randomNumber(3),
        'zip_code' => $faker->randomNumber(9),
        'city' => $faker->city,
        'state' => $faker->state,
        'address_type' => 'ADDRESS_DELIVERY'
    ];
});
