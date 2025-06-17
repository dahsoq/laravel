<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    // Показываем список рецептов
    public function index()
    {
        $recipes = Recipe::with(['details', 'ingredients'])->get();
        return view('fastFoodCategory', compact('recipes'));
    }

    // Сохраняем новый рецепт с деталями и ингредиентами
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

        // Загрузка изображения
        $image = $request->file('imgpath');
        $filename = time() . '_' . $image->getClientOriginalName();
        $image->move(public_path('Image'), $filename);
        $validated['imgpath'] = 'Image/' . $filename;

        // Создаем рецепт
        $recipe = Recipe::create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'timeforcooking' => $validated['timeforcooking'],
            'amountofcalories' => $validated['amountofcalories'],
            'imgpath' => $validated['imgpath'],
        ]);

        // Создаем детали рецепта
        $recipe->details()->create([
            'servings' => $validated['servings'],
            'instruction' => $validated['instruction'],
        ]);

        // Создаем ингредиенты
        foreach ($validated['ingredients'] as $ingredient) {
            $recipe->ingredients()->create($ingredient);
        }

        return redirect()->route('recipe.index')->with('success', 'Рецепт успешно добавлен!');
    }

    // Возвращаем рецепт с деталями и ингредиентами в формате JSON (для JS)
    public function showJson($id)
    {
        $recipe = Recipe::with(['details', 'ingredients'])->findOrFail($id);
        return response()->json($recipe);
    }
}
