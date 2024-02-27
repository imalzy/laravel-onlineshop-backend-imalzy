<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Products>
 */
class ProductsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'description' => $this->faker->text(100),
            'image' => $this->faker->imageUrl(),
            'stock' => $this->faker->numberBetween(0, 100),
            'price' => $this->faker->randomFloat(2, 1, 100),
            'status' => $this->faker->boolean(),
            'is_favourite' => $this->faker->boolean(),
            'category_id' => $this->faker->numberBetween(1, 3),
        ];
    }
}
