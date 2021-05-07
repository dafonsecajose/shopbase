<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\ItemOrder;

class ItemOrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ItemOrder::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {


            return [
                'price' => $this->faker->randomFloat(2, 2, 10),
                'amount' => $this->faker->randomNumber(2)
            ];
    }
}
