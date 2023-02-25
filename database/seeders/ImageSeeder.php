<?php

namespace Database\Seeders;

use App\Models\Image\Image;
use Illuminate\Database\Seeder;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Image::create([
            'name' => 'Chair',
            'file' => asset('storage/image/sample.png'),
            'enable' => 1
        ]);
    }
}
