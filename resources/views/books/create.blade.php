@extends('layouts.app')
@section('content')
<div class="max-w-3xl mx-auto p-8 bg-white">
    <h1 class="text-2xl font-bold mb-6">Add A Book</h1>
    <form action="/books" method="POST">
        @csrf
        <label class="block mb-6">
            <span class="text-gray-700">Title</span>
            <input class="form-input mt-1 block w-64" placeholder="Grapes of Wrath" name="title">
        </label>
        <div class="flex mb-6">
            <label class="block flex-grow mr-4">
                <span class="text-gray-700">Author</span>
                <select class="form-select mt-1 block w-64" name="author_id">
                    @foreach($authors as $author)
                    <option value="{{$author->id}}">{{$author->name}}</option>
                    @endforeach
                </select>
                <a href="/authors/create" class="text-sm text-blue-700 italic mt-2 block" target="blank">Add an author</a>
            </label>
            <div class="block flex-grow">
                <span class="text-gray-700">Categories</span>
                <div class="mt-2">
                    @foreach($categories as $category)
                    <div>
                        <label class="inline-flex items-center">
                            <input type="checkbox" value="{{$category->id}}" name="category_id" class="form-checkbox" >
                            <span class="ml-2">{{$category->title}}</span>
                        </label>
                    </div>
                    @endforeach
                    <a href="/categories/create" class="text-sm text-blue-700 italic mt-2 block" target="blank">Add a category</a>
                </div>
            </div>
        </div>
        <label class="block mb-6">
            <span class="text-gray-700 mb-1 block">Image</span>
            <input type="hidden" role="uploadcare-uploader" data-image-shrink="1024x1024" name="photo" />
        </label>
        <label class="block mb-6">
            <span class="text-gray-700">Description</span>
            <textarea class="form-textarea mt-1 block w-full" rows="3" placeholder="Enter some long form content." name="description"></textarea>
        </label>
        <label class="block mb-6">
            <span class="text-gray-700">Price</span>
            <div class="flex items-center">
                <span class="text-gray-700 text-xl mr-2">$</span><input class="form-input mt-1 block w-32 " placeholder="11.00" name="cost">
            </div>
        </label>

        <button type="submit" class="bg-blue-700 text-white p-2 rounded-sm uppercase tracking-wide">Submit</button>
    </form>
</div>
@endsection