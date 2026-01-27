<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Step extends Model
{
    protected $fillable = ['stepDescription', 'stepOrder'];

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}
