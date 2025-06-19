<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{

    public function index()
    {
        $recipes = Recipe::with(['details', 'ingredients'])->get();
        return view('fastFoodCategory', compact('recipes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'timeforcooking' => 'required|string|max:100',
            'amountofcalories' => 'required|string|max:100',
            'imgpath' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'servings' => 'required|integer',
            'instruction' => 'required|string',
            'ingredients' => 'required|array',
            'ingredients.*.name' => 'required|string',
            'ingredients.*.amount' => 'required|string',
        ]);

       
        $image = $request->file('imgpath');
        $filename = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('Image'), $filename);
        $validated['imgpath'] = 'Image/' . $filename;

       
        $recipe = Recipe::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'timeforcooking' => $validated['timeforcooking'],
            'amountofcalories' => $validated['amountofcalories'],
            'imgpath' => $validated['imgpath'],
        ]);

       
        $recipe->details()->create([
            'servings' => $validated['servings'],
            'instruction' => $validated['instruction'],
        ]);

        foreach ($validated['ingredients'] as $ingredient) {
            $recipe->ingredients()->create($ingredient);
        }

        return redirect()->route('recipe.index')->with('success', 'Рецепт успешно добавлен!');
    }


    public function destroy($id)
    {
        $recipe = Recipe::findOrFail($id);

   
        $recipe->delete();

        return response()->json(['message' => 'Рецепт успешно удалён']);
    }



    public function showJson($id)
    {
        $recipe = Recipe::with(['details', 'ingredients'])->findOrFail($id);
        return response()->json($recipe);
    }
}
