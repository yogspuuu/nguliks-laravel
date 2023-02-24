<?php

namespace App\Http\Controllers;

use App\Http\Resources\Category\CategoryResource;
use App\Http\Resources\Image\ImageResource;
use App\Http\Resources\Product\ProductCollection;
use App\Http\Resources\Product\ProductResource;
use App\Models\Category;
use App\Models\Image;
use App\Models\Product;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected function productResponse($product, bool $status, string $message = null, object|array $pagination = null): JsonResponse
    {
        if (!$status) {
            return $this->failed();
        }

        if ($product instanceof Product) {
            $data = new ProductResource($product);
        } else {
            $data = new ProductCollection($product);
        }

        return $this->success(data: $data, message: $message, pagination: $pagination);
    }

    protected function categoryResponse($category, bool $status, string $message = null, object|array $pagination = null): JsonResponse
    {
        if (!$status) {
            return $this->failed();
        }

        $data = new CategoryResource($category);

        return $this->success(data: $data, message: $message, pagination: $pagination);
    }

    protected function imageResponse($image, bool $status, string $message = null, object|array $pagination = null): JsonResponse
    {
        if (!$status) {
            return $this->failed();
        }

        $data = new ImageResource($image);

        return $this->success(data: $data, message: $message, pagination: $pagination);
    }

    protected function success(object|array $data = null, string $message = null, bool $status = true, object|array $pagination = null): JsonResponse
    {
        $responses = [
            'status' => $status,
            'message' => $message,
            'data' => $data,
            'pagination' => $pagination
        ];

        return response()->json($responses, Response::HTTP_OK);
    }

    protected function failed(string $message = null, bool $status = false): JsonResponse
    {
        $responses = [
            'status' => $status,
            'message' => $message
        ];

        return response()->json($responses, Response::HTTP_BAD_REQUEST);
    }
}
