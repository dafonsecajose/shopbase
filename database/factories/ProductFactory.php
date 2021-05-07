<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Product;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {

            return [
            'name' => $this->faker->name,
            'resume' => $this->faker->sentence,
            'description' => $this->faker->paragraph(4, true),
            'price' => $this->faker->randomFloat(2, 2, 10),
            'height' => $this->faker->randomFloat(2, 2, 10),
            'width' => $this->faker->randomFloat(2, 2, 10),
            'weight' => $this->faker->randomFloat(2, 2, 10),
            'depth' => $this->faker->randomFloat(2, 2, 10),
            'amount' => $this->faker->randomNumber(3),
            'active' => 'OK',
            'slug'  => $this->faker->slug
            ];
    }
}
