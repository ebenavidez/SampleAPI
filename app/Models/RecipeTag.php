<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class RecipeTag extends Pivot
{
    protected $fillable = [
        'recipe_id',
        'tag_id',
    ];
}

