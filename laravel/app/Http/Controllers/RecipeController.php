<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function home ()
    {
        $recipes = Recipe::with(['category', 'user'])->limit(3)->get();
        $categories = Category::all();
        $recipesTotal = Recipe::count();

        return view('home', compact('recipes', 'categories', 'recipesTotal'));
    }
}
