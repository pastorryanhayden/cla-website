<?php

namespace App\Http\Controllers;

use App\Category;
use App\Author;
use App\Book;
use App\Http\Requests\BooksRequest;
use App\Http\Requests\BooksUpdateRequest;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();
        return view('books.index', compact('books'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $authors = Author::all();
        return view('books.create', compact('categories', 'authors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BooksRequest $request)
    {
        $validated = $request->validated();
        $book = new Book;
        $book->title = $validated['title'];
        $book->cost = $validated['cost'];
        $book->author_id = $validated['author_id'];
        $book->description = $validated['description'];
        $book->photo = $validated['photo'];
        $book->save();
        $book->categories()->attach($validated['category_id']);
       
        return redirect('/books');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $book = Book::find($id);
        $categories = Category::all();
        $authors = Author::all();
        return view('books.edit', compact('book', 'authors', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BooksUpdateRequest $request, $id)
    {
        $validated = $request->validated();
        $book = Book::find($id);
        $book->title = $validated['title'];
        $book->cost = $validated['cost'];
        $book->author_id = $validated['author_id'];
        $book->description = $validated['description'];
        $book->photo = $validated['photo'];
        $book->save();
        $book->categories()->attach($validated['category_id']);
        return redirect('/books');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Book::destroy($id);
        return redirect('/books');
    }
}
