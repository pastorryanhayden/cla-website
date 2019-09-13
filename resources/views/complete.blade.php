<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order Marked Complete</title>
    <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="p-12">
    <h1 class="text-xl font-bold">We've marked order {{$order->id}} as complete.</h1>
    <p>We are sending an email to {{$order->customer->name}} at {{$order->customer->email}} to let them know their books are on the way.</p>
</body>

</html>