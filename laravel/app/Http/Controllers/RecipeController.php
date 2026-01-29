<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\Step;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function recipes ()
    {
        $recipes = Recipe::with(['category', 'user'])->withCount('comments')->get();
        $categories = Category::all();
        $ingredients = Ingredient::all();

        return view('recipes', compact('recipes', 'categories', 'ingredients'));
    }

    public function editRecipeForm ()
    {
        return view('editRecipe');
    }
    
    public function addRecipe (Request $request)
    {
        $recipe = Recipe::create([
            'recipeTitle' => $request->title,
            'recipeDescription' => $request->description,
            'image' => $request->image,
            'user_id' => Auth::id(),
            'category_id' => $request->category
        ]);

        foreach ($request->ingredients as $name) {
            $ingredient = Ingredient::where('ingredientTitle', $name)->first();

            if ($ingredient) {
                $recipe->ingredients()->attach($ingredient->id);
            }
        }

        $order = 1;
        foreach ($request->steps as $step) {
            if (!empty($step)) {
                Step::create([
                    'stepDescription' => $step,
                    'stepOrder' => $order++,
                    'recipe_id' => $recipe->id
                ]);
            }
        }

        return redirect('/recipes');

    }
}
