<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class RecipeCategory extends Pivot
{
    protected $fillable = [
        'recipe_id',
        'category_id',
    ];
}
