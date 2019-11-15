<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    <title>Christian Law Association Books</title>

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
    <h2>You've successfully completed the order.  You should be receiving an email from us shortly with shipping details.  Thank you.</h2>
    </div>
</body>

</html>