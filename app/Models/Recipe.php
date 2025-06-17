<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = ['name', 'description', 'timeforcooking', 'amountofcalories', 'imgpath'];
    public function details()
    {
        return $this->hasOne(RecipeDetail::class);
    }

    public function ingredients()
    {
        return $this->hasMany(Ingredient::class);
    }
}
