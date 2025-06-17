<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecipeDetail extends Model
{
    protected $fillable = ['recipe_id', 'servings', 'instruction'];

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}
