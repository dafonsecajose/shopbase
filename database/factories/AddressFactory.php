<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Address;

class AddressFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Address::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
        'street' => $this->faker->streetName,
        'neighborhood' => $this->faker->name ,
        'house_code' => $this->faker->randomNumber(3),
        'zip_code' => $this->faker->randomNumber(9),
        'city' => $this->faker->city,
        'state' => $this->faker->state,
        'address_type' => 'ADDRESS_DELIVERY'
        ];
    }
}
