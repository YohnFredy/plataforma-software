<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Ejecutar el seeder que borra las imágenes
       /*  $this->call(ClearImagesSeeder::class); */
        
        User::factory()->create([
            'name' => 'Yohn Fredy',
            'last_name' => 'Guapacha Hurtado',
            'dni' => 94154629,
            'username' => 'master',
            'email' => 'fredy.guapacha@gmail.com',
            'password' => bcrypt('123'),
        ]);
        User::factory(2)->create(); 
    
        $this->call([
            CountrySeeder::class,
            DepartmentSeeder::class,
            CitySeeder::class,
            RegisterRedSeeder::class,
            CategorySeeder::class,
            ImageSeeder::class,
        ]);

        Brand::factory(2)->create();

        Product::factory(5)->create();
    }
}
