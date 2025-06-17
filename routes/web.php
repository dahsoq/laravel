<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn() => view('main'));
Route::get('/category', fn() => view('recipes'));
Route::get('/contact', fn() => view('contact'));

Route::get('/category/fastfood', [RecipeController::class, 'index'])->name('recipe.index');
Route::get('/recipe/{id}/json', [RecipeController::class, 'showJson'])->name('recipe.details.json');

Route::get('/comments', [CommentController::class, 'index']);
Route::post('/comments', [CommentController::class, 'store']);

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/panel', fn() => view('admin.panel'));
    Route::post('/recipes', [RecipeController::class, 'store'])->name('recipe.store');
});

Route::get('/dashboard', fn() => view('dashboard'))
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'admin'])->group(function () {
Route::delete('/recipe/{id}', [RecipeController::class, 'destroy'])->name('recipe.destroy');
});


require __DIR__ . '/auth.php';
