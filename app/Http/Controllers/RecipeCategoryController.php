<?php

namespace App\Http\Controllers;
use App\Models\Recipe;
use App\Models\Category;

class RecipeCategoryController extends Controller
{
    // Add category to a recipe
    public function addCategoryToRecipe(Recipe $recipe, Category $category)
    {
        $recipe->categories()->syncWithoutDetaching([
            $category->id
        ]);

        return response()->json(['message' => 'Category added successfully to the recipe.']);
    }

    // Remove category to a recipe
    public function removeIngredientFromRecipe(Recipe $recipe, Category $category)
    {
        // Check if the category is associated with the recipe
        if (!$recipe->categories()->where('category_id', $category->id)->exists()) {
            return response()->json(['message' => 'Recipe does not belong to the category.'], 404);
        }

        // Detach the category from the recipe
        $recipe->categories()->detach($category->id);

        return response()->json([
            'message' => 'Category removed from the recipe successfully.',
        ]);
    }
}
