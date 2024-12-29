<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRecipeRequest;
use App\Http\Requests\UpdateRecipeRequest;
use App\Http\Resources\RecipeResource;
use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    // Fetch all recipes
    public function index()
    {
        $recipes = Recipe::with(['categories', 'ingredients'])->paginate(10);

        return RecipeResource::collection($recipes);
    }

    // Show a single recipe
    public function show(Recipe $recipe)
    {
        $recipe->load(['categories', 'ingredients']);

        return new RecipeResource($recipe);
    }

    // Store a new recipe
    public function store(StoreRecipeRequest $request)
    {
        $validated = $request->validated();
        $recipe = Recipe::create($validated);

        return new RecipeResource($recipe);
    }


    // Update a recipe
    public function update(UpdateRecipeRequest $request, Recipe $recipe)
    {
        $validated = $request->validated();
        $recipe->update($validated);

        return new RecipeResource($recipe);
    }

    // Delete a recipe
    public function destroy(Recipe $recipe)
    {
        $recipe->delete();

        return response()->json(['message' => 'Recipe deleted successfully'], 200);
    }

    // Search recipes
    public function search(Request $request)
    {
        $query = $request->input('query');

        $recipes = Recipe::query()
            ->where('title', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->with(['categories', 'ingredients'])
            ->paginate(10);

        return RecipeResource::collection($recipes);
    }
}

