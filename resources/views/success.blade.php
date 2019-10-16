@extends('layouts.donate')
@section('content')
<div class="flex justify-center items-center h-screen w-full">
    <div class="max-w-xl bg-gray-200">
        <section class="title flex p-6 border-b items-center">
            <div class="mr-12">
                <h3 class="text-lg">Donate To</h3>
                <h1 class="text-bold text-2xl">{{$name}}</h1>
            </div>
            <img src="{{$image}}" alt="" class="w-24 h-24 rounded-full">
        </section>
        <section class="form p-12">
        <h2 class="text-lg text-center">Thank you for your generous donation!</h2>
        </section>
    </div>
   

    </section>

</div>
@endsection