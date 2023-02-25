<?php

namespace Database\Seeders;

use App\Models\Category\Category;
use App\Models\Image\Image;
use App\Models\Product\Product;
use App\Models\Product\ProductCategory;
use App\Models\Product\ProductImage;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $product = Product::create([
            'name' => 'Chair',
            'description' => 'Beautiful chair!',
            'enable' => 1
        ]);

        ProductCategory::create([
            'product_id' => $product->id,
            'category_id' => Category::first()->id
        ]);

        ProductImage::create([
            'product_id' => $product->id,
            'image_id' => Image::first()->id
        ]);
    }
}
