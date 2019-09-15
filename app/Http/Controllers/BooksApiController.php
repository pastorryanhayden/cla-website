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
        return response()->json([
            'categories' => $categories,
        ]);
    }
}
