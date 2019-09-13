<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $gaurded = [];
    public function books()
    {
        return $this->belongsToMany(Book::class);
    }
}
