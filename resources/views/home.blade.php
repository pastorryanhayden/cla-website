@extends('layouts.app')

@section('content')
<div class="flex items-center">
    <div class="md:w-1/2 md:mx-auto">

        @if (session('status'))
        <div class="text-sm border border-t-8 rounded text-green-700 border-green-600 bg-green-100 px-3 py-4 mb-4" role="alert">
            {{ session('status') }}
        </div>
        @endif

        <div class="flex flex-col break-words bg-white border border-2 rounded shadow-md">

            <div class="font-semibold bg-gray-200 text-gray-700 py-3 px-6 mb-0">
                Dashboard
            </div>

            <div class="w-full p-6">
                <p class="text-gray-700">
                    <a href="#" class="block mb-6 text-xl text-gray-400 hover:text-blue-500">Manage Orders (Coming Soon)</a>
                    <a href="/books/" class="block mb-6 text-xl text-blue-700 hover:text-blue-500">Manage Books</a>
                    <a href="/authors/" class="block mb-6 text-xl text-blue-700 hover:text-blue-500">Manage Authors</a>
                    <a href="/categories/" class="block mb-6 text-xl text-blue-700 hover:text-blue-500">Manage Categories</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection