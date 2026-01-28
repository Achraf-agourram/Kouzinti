<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Ingredient;
use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function home ()
    {
        $recipes = Recipe::with(['category', 'user'])->withCount('comments')->limit(3)->get();
        $recipesTotal = Recipe::count();
        $categories = Category::all();
        $chefsTotal = Recipe::distinct('user_id')->count('user_id');
        $ingredients = Ingredient::all();

        return view('home', compact('recipes', 'categories', 'recipesTotal', 'chefsTotal', 'ingredients'));
    }
}
