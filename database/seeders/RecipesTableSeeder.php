<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Recipe;

class RecipesTableSeeder extends Seeder
{
    public function run()
    {
        Recipe::create([
            'title' => 'Spaghetti Carbonara',
            'description' => 'A classic Italian pasta dish.',
            'prep_time' => 10,
            'cook_time' => 15,
            'total_time' => 25,
            'servings' => 4,
            'shared_by' => 'Ethel Benavidez',
        ]);
    }
}
