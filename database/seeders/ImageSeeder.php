<?php

namespace Database\Seeders;

use App\Models\Image;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {

        Image::create([
            'path' => 'products/11b646d83840b5663dea3e114890d7f2.png',
            'imageable_type' =>'App\Models\Product',
            'imageable_id' => 1,
        ]);
        Image::create([
            'path' => 'products/12e4d36c806f6fac61d7c3e67fe5f41e.png',
            'imageable_type' =>'App\Models\Product',
            'imageable_id' => 2,
        ]);
        Image::create([
            'path' => 'products/810b5c1c09a436f340d91ba4b7de6c53.png',
            'imageable_type' =>'App\Models\Product',
            'imageable_id' => 3,
        ]);
        Image::create([
            'path' => 'products/a596831bcd0257e3ccd8291fae855317.png',
            'imageable_type' =>'App\Models\Product',
            'imageable_id' => 4,
        ]);
        Image::create([
            'path' => 'products/ceb5221e4fe624995935934ca4a35f2d.png',
            'imageable_type' =>'App\Models\Product',
            'imageable_id' => 5,
        ]);

    }
}
