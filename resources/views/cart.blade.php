<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    {{-- <link href="/css/vue-store.css" rel="stylesheet"> --}}
    <title>Christian Law Association Books</title>
    {{-- <script src="/js/vue-store.js"></script> --}}
</head>

<body>
    <nav class="bg-red-700 w-full p-2 text-white mb-8">
        <div class="max-w-5xl mx-auto flex justify-between items-center">
            <img src="/images/logo2.png" alt="" class="h-8">
            <ul>
                <li class="uppercase tracking-wide hover:opacity-75"><a href="{{ env('PARENT_SITE'), 'https://cla.mustincrease.com' }}">Main Site</a></li>
            </ul>
        </div>
    </nav>
    <div class="max-w-5xl mx-auto">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-3xl">Cart</h2>
        <a href="/bookstore" class="font-bold text-blue-500 text-lg">Return to List</a>
    </div>
    <div>
        <ul class="list-reset">
            @foreach(session('cart') as $item)
            <li class="flex mb-6 pb-6 border-b" id="item{{$loop->index}}">
                <img src="{{ $item['item']->photo }}" alt="" class="h-48 block mr-4 ">
                <div class="details flex w-full">
                    <div class="title w-1/2">
                        <h4 class="font-bold text-lg">{{ $item['item']->title }}</h4>
                        <p class="hidden lg:block">{{ $item['item']->description }}</p>
                        <form action="/cart/remove/{{$loop->index}}" method="POST">
                        @csrf 
                        <button type="submit" class="no-underline text-red-700 inline-flex mt-4">@svg('trash', 'h-6 text-red-700 mr-2') Remove From Cart</button>
                        </form>
                      
                    </div>
                    <div class="price w-1/4">
                        <p class="text-center text-lg text-gray-600">${{ number_format($item['item']->cost, 2, '.', ',')}}</p>
                    </div>
                    <form class="quant w-1/4" action="/updateItemQuantity/{{$loop->index}}" method="POST">
                        @csrf
                        <input type="number" name="quantity" id="" class="border w-16 py-2 pl-4 mx-auto block" value="{{ $item['quant'] }}" onchange="showUpdateCart('item{{$loop->index}}')">
                        <button class="updatebutton text-white bg-blue-500 py-1 px-2 hidden mx-auto block mt-2" type="submit">Update</button>
                    </form>
                </div>
            </li>
            @endforeach
        </ul>
        <div class="flex justify-end mb-6">
            <p class="total text-lg">Total: <strong class="text-red">${{ number_format($total, 2, '.', ',')}}</strong></p>
        </div>
        <div class="flex justify-end">
            <a href="/checkout" class="bg-blue-500 text-white px-4 py-2 rounded uppercase tracking-wide" @click="toCheckout">Checkout</a>
        </div>
    </div>
</div>
    <script>
        var showUpdateCart = (id) => {
            document.querySelector(`#${id} button.updatebutton`).classList.remove('hidden');
        }
    </script>
</body>

</html>