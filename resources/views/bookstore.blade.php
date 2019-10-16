<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <link href="/css/vue-store.css" rel="stylesheet">
    <title>Christian Law Association Books</title>
    <script src="/js/vue-store.js"></script>
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
    <script src="https://js.stripe.com/v3/"> </script>
    <div class="max-w-3xl mx-auto">
        <vue-widget title="Bookstore"></vue-widget>
    </div>


</body>

</html>