<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['categoryTitle', 'categoryImage'];

    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }
}
