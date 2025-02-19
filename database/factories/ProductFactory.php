<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;
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
      $CategoryId = Category::where('is_final', true)->inRandomOrder()->value('id');
        $brand = Brand::inRandomOrder()->first()->id;

        return [
            'name' => $this->faker->word,
            'slug' => Str::slug($this->faker->unique()->word),
            'description' => $this->faker->paragraph,
            /* 'price' => $this->faker->randomFloat(2, 10, 1000), */
            'price' => 28.75,
            'commission_income' => 5.71,
            'pts' => 5,
            'specifications' => $this->faker->paragraph,
            'information' => $this->faker->paragraph,
            'stock' => $this->faker->numberBetween(0, 100),
            'category_id' => $CategoryId,
            'brand_id' => $brand,
        ];
    }
}
