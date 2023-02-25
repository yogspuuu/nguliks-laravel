<?php

namespace App\Http\Requests\Product;

use Illuminate\Foundation\Http\FormRequest;

class ProductCreateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string',
            'description' => 'required|string',
            'category_id' => 'required|integer',
            'image_id' => 'required|integer',
            'enable' => 'required|boolean',
        ];
    }
}
