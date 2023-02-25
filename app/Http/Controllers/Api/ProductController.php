<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\ProductCreateRequest;
use App\Http\Requests\Product\ProductUpdateRequest;
use App\Models\Product\Product;
use App\Models\Product\ProductCategory;
use App\Models\Product\ProductImage;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    protected $product;
    protected $productCategory;
    protected $productImage;

    public function __construct(Product $product, ProductCategory $productCategory, ProductImage $productImage)
    {
        $this->product = $product;
        $this->productCategory = $productCategory;
        $this->productImage = $productImage;
    }

    public function create(ProductCreateRequest $request): JsonResponse
    {
        $product = $this->product->create($request->all());

        $this->product->saveCategory($product, $request);
        $this->product->saveImage($product, $request);

        return $this->productResponse(
            product: $product,
            status: true,
            message: 'Successfully create new product!',
        );
    }

    public function list(): JsonResponse
    {
        $product = $this->product->where('enable', 1)->paginate(10);

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

        $this->product->updateCategory($product, $request);
        $this->product->updateImage($product, $request);

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
