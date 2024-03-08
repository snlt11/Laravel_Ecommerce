<?php

namespace App\Http\Requests;

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
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'tag_id' => 'required',
            'name' => 'required|unique:products',
            'price' => 'required',
            'images' => 'required',
            'colors' => 'required',
            'sizes' => 'required',
            'description' => 'required'
        ];
    }
}
