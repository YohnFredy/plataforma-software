<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $category = Category::factory()->create([
            'name' => 'Productos Naturales',
            'slug' => Str::slug('Productos Naturales'),
            'parent_id' => null,
            'is_final' => false,
            'is_active' => true,
        ]);

        Category::factory(2)->create([
            'parent_id' => $category->id,
            'is_final' => true,
        ]);         
    }
}
