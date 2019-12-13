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
    <script src="https://js.stripe.com/v3/"> </script>
    <div class="max-w-5xl mx-auto">
    @include('includes.checkoutmenu')
    <form class="max-w-lg mx-auto" action="/checkout" method="POST" id="payment-form">
    @csrf
    <input type="hidden" name="ammount" value="{{$total}}">
    <label class="block mb-6">
    <span class="text-gray-700">Name</span>
    <input class="form-input mt-1 block w-full" placeholder="Jane Doe" name="name">
    </label>
    <label class="block mb-6">
    <span class="text-gray-700">Email</span>
    <input class="form-input mt-1 block w-full" placeholder="jane.doe@email.com" name="email">
    </label>
    <h2 class="font-bold mb-2">Shipping Address</h2>
    <input class="form-input mt-1 block w-full" placeholder="3401 Street Name" name="address1">
    <input class="form-input mt-1 block w-full" placeholder="APT. 215" name="address2">
    <div class="flex mt-1 mb-6">
    <input class="form-input mt-1 block w-1/2 mr-1" placeholder="Nashua" name="city">
    <input class="form-input mt-1 block w-1/4 mr-1" placeholder="NH" name="state">
    <input class="form-input mt-1 block w-1/4" placeholder="03050" name="zip">
    </div>

    <div id="card-element" class="mt-6 border py-2 px-2">
      <!-- A Stripe Element will be inserted here. -->
    </div>
    <div id="card-errors" role="alert"></div>
    <button class="mt-6 py-2 px-4 bg-blue-500 text-white rounded-sm" type="submit">Pay &amp; Submit Order</button>
    </form>
    </div>
    <script>
    // Create a Stripe client.
        var stripe = Stripe('{{ $publicKey }}');
        // Create an instance of Elements.
        var elements = stripe.elements();

        // Custom styling can be passed to options when creating an Element.
        // (Note that this demo uses a wider set of styles than the guide below.)
        var style = {
        base: {
            color: '#32325d',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
            color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
        };

        // Create an instance of the card Element.
        var card = elements.create('card', {style: style});

        // Add an instance of the card Element into the `card-element` <div>.
        card.mount('#card-element');

        // Handle real-time validation errors from the card Element.
        card.addEventListener('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
            displayError.textContent = event.error.message;
        } else {
            displayError.textContent = '';
        }
        });

        // Handle form submission.
        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
        event.preventDefault();

        stripe.createToken(card).then(function(result) {
            if (result.error) {
            // Inform the user if there was an error.
            var errorElement = document.getElementById('card-errors');
            errorElement.textContent = result.error.message;
            } else {
            // Send the token to your server.
            stripeTokenHandler(result.token);
            }
        });
        });

        // Submit the form with the token ID.
        function stripeTokenHandler(token) {
        // Insert the token ID into the form so it gets submitted to the server
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);

        // Submit the form
        form.submit();
        }

    </script>
</body>

</html>