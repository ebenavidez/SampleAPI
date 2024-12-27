<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTagRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Set to false if you want to add authorization logic
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:tags,name',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The tag name is required.',
            'name.unique' => 'This tag already exists.',
        ];
    }
}
