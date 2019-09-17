@extends('layouts.app')
@section('content')
<div class="max-w-3xl mx-auto p-8 bg-white">
    <h1 class="text-2xl font-bold mb-6">Books</h1>
    <table class="table mb-6">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Author</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $book)
            <tr>
                <th scope="row">{{$book->id}}</th> 
                <td>{{$book->title}}</td>
                <td>{{$book->author->name}}</td>
                <td>
                    <a href="/books/{{$book->id}}/edit" class="inline-flex p-2 bg-blue-700 text-white">Edit</a>
                    <form action="/books/{{$book->id}}" method="post" class="inline">
                        @csrf
                        @method('delete')
                        <button class="inline-flex p-2 bg-red-700 text-white">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="/books/create" class="bg-blue-700 text-white p-2 rounded-sm uppercase tracking-wide">Add book</a>
</div>
@endsection