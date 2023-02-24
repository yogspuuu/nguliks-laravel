<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\CategoryCreateRequest;
use App\Http\Requests\Category\CategoryUpdateRequest;
use App\Models\Category;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    protected $category;

    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    public function create(CategoryCreateRequest $request): JsonResponse
    {
        $category = $this->category->create($request->all());

        return $this->categoryResponse(
            category: $category,
            status: true,
            message: 'Successfully create category!'
        );
    }

    public function list(): JsonResponse
    {
        $category = $this->category->get();

        return $this->categoryResponse(
            category: $category,
            status: true,
            message: 'Successfully get category!'
        );
    }

    public function detail(Category $category): JsonResponse
    {
        return $this->categoryResponse(
            category: $category,
            status: true,
            message: 'Successfully get category details!'
        );
    }

    public function update(CategoryUpdateRequest $request, Category $category): JsonResponse
    {
        $category->update($request->all());

        return $this->categoryResponse(
            category: $category,
            status: true,
            message: 'Successfully update category!'
        );
    }

    public function delete(Category $category): JsonResponse
    {
        $category->delete();

        return $this->categoryResponse(
            category: $category,
            status: true,
            message: 'Successfully delete category!'
        );
    }
}
