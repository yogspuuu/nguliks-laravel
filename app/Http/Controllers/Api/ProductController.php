<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductCreateRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Models\Product\Product;
use App\Models\Product\ProductCategory;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    protected $product;
    protected $productCategory;

    public function __construct(Product $product, ProductCategory $productCategory)
    {
        $this->product = $product;
        $this->productCategory = $productCategory;
    }

    public function create(ProductCreateRequest $request): JsonResponse
    {
        $product = $this->product->create($request->all());

        $this->productCategory->create([
            'product_id' => $product->id,
            'category_id' => $request->category_id
        ]);

        return $this->productResponse(
            product: $product,
            status: true,
            message: 'Successfully create new product!',
        );
    }

    public function list(): JsonResponse
    {
        $product = $this->product->where('enable', 1)->get();

        return $this->productResponse(
            product: $product,
            status: true,
            message: 'Successfully get all product lists!'
        );
    }

    public function detail(Product $product): JsonResponse
    {
        return $this->productResponse(
            product: $product,
            status: true,
            message: 'Successfully get product details!'
        );
    }

    public function update(ProductUpdateRequest $request, Product $product): JsonResponse
    {
        $product->update($request->all());

        $this->productCategory->where('product_id', $product->id)->update([
            'category_id' => $request->category_id
        ]);

        return $this->productResponse(
            product: $product,
            status: true,
            message: 'Successfully update product!'
        );
    }

    public function delete(Product $product): JsonResponse
    {
        $product->delete();

        return $this->productResponse(
            product: $product,
            status: true,
            message: 'Successfully deletw product!'
        );
    }
}
