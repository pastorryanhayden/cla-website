@extends('layouts.app')
@section('content')
<div class="max-w-3xl mx-auto p-8 bg-white">
    <h1 class="text-2xl font-bold mb-6">Edit {{$author->name}}</h1>
    <form action="/authors/{{$author->id}}" method="POST">
        @csrf
        @method('put')
        <label class="block mb-6">
            <span class="text-gray-700">Name</span>
            <input class="form-input mt-1 block w-full" placeholder="Grapes of Wrath" name="name" value="{{$author->name}}">
        </label>
        <label class="block mb-6">
            <span class="text-gray-700">Bio</span>
            <textarea class="form-textarea mt-1 block w-full" rows="3" placeholder="Enter some long form content." name="bio">{{$author->bio}}</textarea>
        </label>
        <label class="block mb-6">
            <span class="text-gray-700 mb-1 block">Photo</span>
            <input type="hidden" role="uploadcare-uploader" data-image-shrink="1024x1024" name="photo" value="{{$author->photo}}" />
        </label>
        <button type="submit" class="bg-blue-700 text-white p-2 rounded-sm uppercase tracking-wide">Submit</button>
    </form>
</div>
@endsection