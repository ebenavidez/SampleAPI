<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function store(StoreCategoryRequest $request)
    {
        // Create the category
        $category = Category::create([
            'name' => $request->name,
        ]);

        // Return a JSON response
        return new CategoryResource($category);
    }

    public function search(Request $request)
    {
        $query = $request->input('query');

        $categories = Category::query()
            ->where('name', 'LIKE', "%{$query}%")
            ->orderBy('name')
            ->limit(10) // Limit the results for performance
            ->get();

        return CategoryResource::collection($categories);
    }
}
