<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommentController;

use App\Http\Controllers\RecipeController;

Route::get('/', action: function () {
    return view('main');
});
Route::get('/category', function () {
    return view('recipes');
});
Route::get('/contact', function () {
    return view('contact');
});
Route::get('/category/fastfood', [RecipeController::class, 'index'])->name('recipe.index');
;
Route::get('/comments', [CommentController::class, 'index']);
Route::post('/comments', [CommentController::class, 'store']);
Route::post('/category/fastfood', [RecipeController::class, 'store'])->name('recipe.store');

Route::resource('recipe', RecipeController::class);
Route::get('/recipe/{id}/json', [RecipeController::class, 'showJson'])->name('recipe.details.json');

