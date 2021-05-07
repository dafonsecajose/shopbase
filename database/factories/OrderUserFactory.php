<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\OrderUser;

class OrderUserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderUser::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
            return [
                'reference' => $this->faker->randomNumber(10),
                'pagseguro_code' => $this->faker->randomNumber(10),
                'pagseguro_status' => $this->faker->randomNumber(1)
            ];
    }
}
