<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Support\Str;

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
            'name' => $this->faker->word(),
            'slug' => Str::slug($this->faker->sentence(3)),
            'short_description' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'regular_price' => $this->faker->randomFloat(2, 100, 1000),
            'sale_price' => $this->faker->randomFloat(2, 50, 900),
            'sku' => strtoupper($this->faker->unique()->lexify('???-????')),
            'stock_status' => $this->faker->randomElement(['instock', 'outofstock']),
            'featured' => $this->faker->boolean(),
            'quantity' => $this->faker->numberBetween(1, 50),
            'brand_id' => Brand::inRandomOrder()->first()->id ?? Brand::factory(),
            'image' => 'https://upload.wikimedia.org/wikipedia/commons/thumb/6/65/No-Image-Placeholder.svg/1200px-No-Image-Placeholder.svg.png',
            'images' => json_encode([$this->faker->imageUrl(), $this->faker->imageUrl()]),
        ];
    }
}
