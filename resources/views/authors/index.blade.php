@extends('layouts.app')
@section('content')
<div class="max-w-3xl mx-auto p-8 bg-white">
    <h1 class="text-2xl font-bold mb-6">Authors</h1>
    <table class="table mb-6">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Author</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($authors as $author)
            <tr>
                <th scope="row">{{$author->id}}</th>
                <td>{{$author->name}}</td>
                <td>
                    <a href="/authors/{{$author->id}}/edit" class="inline-flex p-2 bg-blue-700 text-white">Edit</a>
                    <form action="/authors/{{$author->id}}" method="post" class="inline">
                        @csrf
                        @method('delete')
                        <button class="inline-flex p-2 bg-red-700 text-white">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <a href="/authors/create" class="bg-blue-700 text-white p-2 rounded-sm uppercase tracking-wide">Add Author</a>
</div>
@endsection