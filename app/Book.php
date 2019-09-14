<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $gaurded = [];

    public function author()
    {
        return $this->belongsTo(Author::class);
    }
    
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

}