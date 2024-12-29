<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRecipeRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Adjust based on your auth logic
    }

    public function rules()
    {
        return [
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'prep_time' => 'sometimes|required|integer|min:1',
            'cook_time' => 'sometimes|required|integer|min:1',
            'total_time' => 'sometimes|required|integer|min:1',
            'servings' => 'sometimes|required|integer|min:1',
        ];
    }

}