<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
        'name' => fake()->name(),
        'description' => fake()->paragraph(),
        'price' => fake()->numberBetween(10, 9000),
        'manage_stock' => false,
        'in_stock' => fake()->boolean(),
        'slug' => fake()->slug(),
        'sku' => fake()->word(),
        'is_active' => fake()->boolean(),
        ];
    }
}
