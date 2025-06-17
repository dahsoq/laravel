<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Recipe;

class RecipeApiController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->input('query');
        if (!$query)
            return response()->json([]);

        // Разделим по запятой и уберем пробелы
        $keywords = array_filter(array_map('trim', explode(',', $query)));

        $recipes = Recipe::where(function ($q) use ($keywords) {
            foreach ($keywords as $word) {
                $q->orWhere('name', 'like', "%{$word}%")
                    ->orWhereHas(
                        'ingredients',
                        fn($subQ) =>
                        $subQ->where('name', 'like', "%{$word}%")
                    );
            }
        })->with(['details', 'ingredients'])->get();

        return response()->json($recipes);
    }
}
