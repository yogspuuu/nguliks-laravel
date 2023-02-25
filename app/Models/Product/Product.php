<?php

namespace App\Models\Product;

use App\Http\Requests\Product\ProductCreateRequest;
use App\Models\Category\Category;
use App\Models\Image\Image;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product';

    protected $fillable = [
        'name',
        'description',
        'enable'
    ];

    public function category(): Category
    {
        $productCategory = ProductCategory::where('product_id', $this->id)->first();

        return Category::where('id', $productCategory->category_id)->first();
    }

    public function image(): Image
    {
        $productImage = ProductImage::where('product_id', $this->id)->first();

        return Image::where('id', $productImage->image_id)->first();
    }

    public function saveCategory(Product $product, ProductCreateRequest $request): void
    {
        ProductCategory::create([
            'product_id' => $product->id,
            'category_id' => $request->category_id
        ]);
    }

    public function updateCategory(Product $product, Request $request): void
    {
        if (isset($request->category_id)) {
            ProductCategory::where('product_id', $product->id)->update([
                'category_id' => $request->category_id
            ]);
        }
    }

    public function saveImage(Product $product, Request $request): void
    {
        ProductImage::create([
            'product_id' => $product->id,
            'image_id' => $request->image_id
        ]);
    }

    public function updateImage(Product $product, Request $request): void
    {
        if (isset($request->image_id)) {
            ProductImage::where('product_id', $product->id)->update([
                'image_id' => $request->image_id
            ]);
        }
    }
}
