<?php

namespace App\Models\Product;

use App\Models\Category\Category;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product';

    protected $fillable = [
        'name',
        'description',
        'enable'
    ];

    public function category(): Builder
    {
        $productCategory = ProductCategory::where('product_id', $this->id)->first();

        return Category::where('id', $productCategory->category_id);
    }
}
