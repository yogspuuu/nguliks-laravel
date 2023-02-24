<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Image\ImageCreateRequest;
use App\Http\Requests\Image\ImageUpdateRequest;
use App\Models\Image\Image;
use App\Services\ImageService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    protected $image;
    protected $imageService;

    public function __construct(Image $image, ImageService $imageService)
    {
        $this->image = $image;
        $this->imageService = $imageService;
    }

    public function create(ImageCreateRequest $request): JsonResponse
    {
        $this->saveImage($request);

        $image = $this->image->create($request->all());

        return $this->imageResponse(
            image: $image,
            status: true,
            message: 'Successfully create image!'
        );
    }

    public function list(): JsonResponse
    {
        $image = $this->image->where('enable', 1)->get();

        return $this->imageResponse(
            image: $image,
            status: true,
            message: 'Successfully get image!'
        );
    }

    public function detail(Image $image): JsonResponse
    {
        return $this->imageResponse(
            image: $image,
            status: true,
            message: 'Successfully get image details!'
        );
    }

    public function update(ImageUpdateRequest $request, Image $image): JsonResponse
    {
        $this->saveImage($request, $image);

        $image->update($request->all());

        return $this->imageResponse(
            image: $image,
            status: true,
            message: 'Successfully update image!'
        );
    }

    public function delete(Image $image): JsonResponse
    {
        $image->delete();

        return $this->imageResponse(
            image: $image,
            status: true,
            message: 'Successfully delete image!'
        );
    }

    private function saveImage(Request $request, Image $image = null): Request
    {
        $request->merge([
            'file' => $this->imageService->saveImage($request, $image),
        ]);

        return $request;
    }
}
