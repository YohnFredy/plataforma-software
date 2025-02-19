<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    public function definition(): array
    {
      
        $name = $this->faker->unique()->word;
        return [
            'name' => ucfirst($name),
            'slug' => Str::slug($name),
            'parent_id' => null,
            'is_final' => false,
            'is_active' => true,
        ];
    }

}
