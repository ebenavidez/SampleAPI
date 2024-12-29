<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use App\Models\Ingredient;
use App\Http\Requests\StoreRecipeIngredientRequest;
use App\Http\Requests\UpdateRecipeIngredientRequest;
use Illuminate\Http\Request;

class RecipeIngredientController extends Controller
{
    // Add ingredient to a recipe
    public function addIngredientToRecipe(StoreRecipeIngredientRequest $request, Recipe $recipe)
    {
        $validated = $request->validated();

        // Check if the ingredient exists
        $ingredient = Ingredient::where('name', $validated['ingredient_name'])->first();

        if (!$ingredient) {
            // Create a new ingredient if it doesn't exist
            $ingredient = Ingredient::create([
                'name' => $validated['ingredient_name'],
            ]);
        }

        // Add the ingredient to the recipe
        $recipe->ingredients()->syncWithoutDetaching([
            $ingredient->id => [
                'quantity' => $validated['quantity'],
                'unit' => $validated['unit'],
            ]
        ]);

        return response()->json(['message' => 'Ingredient added successfully to the recipe.']);
    }

    public function updateIngredientInRecipe(UpdateRecipeIngredientRequest $request, Recipe $recipe, Ingredient $ingredient)
    {
        $validated = $request->validated();

        // Check if the ingredient is already associated with the recipe
        if (!$recipe->ingredients()->where('ingredient_id', $ingredient->id)->exists()) {
            return response()->json(['message' => 'Ingredient not found in the recipe.'], 404);
        }

        // Update the pivot table (recipe_ingredient) with the new data
        $recipe->ingredients()->updateExistingPivot($ingredient->id, [
            'quantity' => $validated['quantity'],
            'unit' => $validated['unit'],
        ]);

        return response()->json([
            'message' => 'Ingredient updated successfully.',
        ]);
    }

    public function removeIngredientFromRecipe(Recipe $recipe, Ingredient $ingredient)
    {
        // Check if the ingredient is associated with the recipe
        if (!$recipe->ingredients()->where('ingredient_id', $ingredient->id)->exists()) {
            return response()->json(['message' => 'Ingredient not found in the recipe.'], 404);
        }

        // Detach the ingredient from the recipe
        $recipe->ingredients()->detach($ingredient->id);

        return response()->json([
            'message' => 'Ingredient removed from the recipe successfully.',
        ]);
    }

}
