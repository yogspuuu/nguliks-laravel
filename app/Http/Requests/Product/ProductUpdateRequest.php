<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'sometimes|string',
            'description' => 'sometimes|string',
            'category_id' => 'sometimes|integer|exists:category,id',
            'image_id' => 'sometimes|integer|exists:image,id',
            'enable' => 'sometimes|boolean',
        ];
    }
}
