<?php

namespace App\Http\Controllers;

use App\Book;
use App\Category;
use App\Author;
use Illuminate\Http\Request;

class BooksApiController extends Controller
{
    public function index()
    {
        $books = Book::with(['author', 'categories'])->get();
        $categories = Category::all();
        $authors = Author::all();
        return response()->json([
            'books' => $books,
            'categories' => $categories,
            'authors' => $authors
        ]);
    }
    public function catindex()
    {
        $categories = Category::all();
        // Loop through the categories and only return the ones with books (Has to be an easier way to do this.)
        $newcategories = [];
        foreach($categories as $category){
            if($category->books()->count() > 0){
                array_push($newcategories, $category);
            }
        }
        return response()->json([
            'categories' => $newcategories,
        ]);
    }
}
