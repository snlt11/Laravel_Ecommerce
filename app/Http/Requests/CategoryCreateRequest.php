<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryCreateRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }


    public function rules(): array
    {
        return [
            'name'=>'required|unique:categories',
            'image'=>'required'
        ];
    }
    public function messages(){
        return [
            'name.required'=> 'Please Enter Category Name',
            'name.unique'=> 'Name already exists',
            'image.required'=> 'Please Upload Image'
        ];
    }
}
