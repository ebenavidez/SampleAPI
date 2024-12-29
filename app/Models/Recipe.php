<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'prep_time',
        'cook_time',
        'total_time',
        'servings',
        'shared_by',
    ];

    /**
     * Relationship: Recipe has many ingredients (via pivot).
     */
    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'recipe_ingredients')
                    ->withPivot('quantity', 'unit')
                    ->withTimestamps();
    }

    /**
     * Relationship: Recipe belongs to many categories.
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'recipe_categories')->withTimestamps();
    }

    /**
     * Relationship: Recipe has many media files.
     */
    public function media()
    {
        return $this->hasMany(Media::class);
    }
}

