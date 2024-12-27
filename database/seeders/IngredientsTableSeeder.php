<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Ingredient;

class IngredientsTableSeeder extends Seeder
{
    public function run()
    {
        Ingredient::create(['name' => 'Spaghetti']);
        Ingredient::create(['name' => 'Egg']);
        Ingredient::create(['name' => 'Parmesan Cheese']);
    }
}

