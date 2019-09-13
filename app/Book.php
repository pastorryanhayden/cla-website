<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $gaurded = [];

    public function category()
    {
        return $this->belongsToMany(Category::class);
    }

}