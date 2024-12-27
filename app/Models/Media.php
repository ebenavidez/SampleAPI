<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $fillable = [
        'recipe_id',
        'file_path',
    ];

    /**
     * Relationship: Media belongs to a recipe.
     */
    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}

