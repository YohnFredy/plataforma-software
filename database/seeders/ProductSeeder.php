<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Crear categorías principales
         $categories = [];
         for ($i = 1; $i <= 3; $i++) {
             $category = Category::factory()->create([
                 'parent_id' => null,
                 'is_final' => false,
             ]);
 
             // Crear 2 subcategorías por cada categoría principal
             for ($j = 1; $j <= 2; $j++) {
                 $subCategory = Category::factory()->create([
                     'parent_id' => $category->id,
                     'is_final' => true,
                 ]);
                 $categories[] = $subCategory->id;
             }
         }
 
         // Crear marcas
         Brand::factory(3)->create();
 
         // Crear productos y sus imágenes
         Product::factory(10)->create()->each(function ($product) {
             $imagePath = 'products/' . basename(fake()->image(storage_path('app/public/products'), 640, 480, null, false));
             
             Image::create([
                 'path' => $imagePath,
                 'imageable_id' => $product->id,
                 'imageable_type' => Product::class,
             ]);
         });
     }
}
