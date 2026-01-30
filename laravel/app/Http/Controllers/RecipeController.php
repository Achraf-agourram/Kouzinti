<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Ingredient;
use App\Models\Recipe;
use App\Models\Step;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

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

    public function editRecipeForm ($id)
    {
        $recipeToEdit = Recipe::with(['ingredients', 'steps', 'category'])->find($id);
        if (Auth::id() !== $recipeToEdit->user_id) return redirect('/recipes');

        $categories = Category::all();
        $ingredients = Ingredient::all();

        return view('editRecipe', compact('categories', 'ingredients', 'recipeToEdit'));
    }

    public function editRecipe (Request $request)
    {
        $recipe = Recipe::findOrFail($request->recipeId);

        if (Auth::id() !== $recipe->user_id) return redirect('/recipes');

        $recipe->update([
            'recipeTitle' => $request->title,
            'recipeDescription' => $request->description,
            'image' => $request->image,
            'category_id' => $request->category
        ]);

        $recipe->ingredients()->detach();

        foreach ($request->ingredients as $name) {
            $ingredient = Ingredient::where('ingredientTitle', $name)->first();

            if ($ingredient) {
                $recipe->ingredients()->attach($ingredient->id);
            }
        }

        $steps = array_filter($request->steps);
        $stepsIds = array_keys($steps);

        foreach($stepsIds as $id) {
            $stepToEdit = Step::findOrFail($id);

            $stepToEdit->update([
                'stepDescription' => $steps[$id]
            ]);
        }

        return Redirect('/recipes');
    }

    public function deleteRecipe (Request $request)
    {
        $recipe = Recipe::findOrFail($request->recipeToDelete);

        if (Auth::id() !== $recipe->user_id) return redirect('/recipes');
        
        $recipe->delete();
        return redirect('/recipes');
    }

    public function recipesByCategory ($category)
    {
        $category = Category::where('categoryTitle', $category)->firstOrFail();
        $recipes = Recipe::with(['category', 'user'])->withCount('comments')->where('category_id', $category->id)->get();

        $categories = Category::all();
        $ingredients = Ingredient::all();

        return view('category', compact('recipes', 'categories', 'ingredients'));
    }
}
