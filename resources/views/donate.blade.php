@extends('layouts.donate')
@section('content')
<div class="flex justify-center items-center h-screen w-full">
    <div class="max-w-2xl bg-gray-200">
        <section class="title flex p-6 border-b items-center">
            <div class="mr-12">
                <h3 class="text-lg">Donate To</h3>
                <h1 class="text-bold text-2xl">{{$name}}</h1>
            </div>
            <img src="{{$image}}" alt="" class="w-24 h-24 rounded-full">
        </section>
        <section class="form">


            <form action="/donate" method="POST" id="payment-form" class="p-12">
                {{ csrf_field() }}
                <div class="form-row">
                    <label for="name" class="mb-2">
                        Your Name
                    </label>
                    <input type="text" name="donator" id="name" class="border py-2 px-4 block mb-6" placeholder="John Doe" required>
                    <label for="email" class="mb-2">
                        Your Email
                    </label>
                    <input type="email" name="email" id="email" class="border py-2 px-4 block mb-6" placeholder="youremail@provider.com" required>
                    <label for="phone" class="mb-2">
                        Your Phone Number
                    </label>
                    <input type="text" name="phone" id="phone" class="border py-2 px-4 block mb-6" placeholder="(111) 111-1111 " required>
                    <label for="address" class="mb-2">
                        Your Billing Address
                    </label>
                    <textarea name="address" id="address" rows="3" class="border py-2 px-4 block mb-6" required></textarea>
                    <label for="amount" class="mb-2">
                        Amount to Donate (in dollars)
                    </label>
                    <input type="number" name="amount" id="amount" class="border py-2 px-4 block mb-6" placeholder="10">
                    <label for="card-element" class="mb-2">
                        Credit or debit card
                    </label>
                    <div id="card-element" class="bg-white py-2 px-4 border mb-6">
                        <!-- A Stripe Element will be inserted here. -->
                    </div>

                    <!-- Used to display Element errors. -->
                    <div id="card-errors" role="alert"></div>
                </div>

                <button class="bg-blue-500 text-white py-2 px-6 rounded">Submit Donation</button>
            </form>
    </div>
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        var stripe = Stripe('{{$key}}');
        var elements = stripe.elements();
        // Custom styling can be passed to options when creating an Element.
        var style = {
            base: {
                // Add your base input styles here. For example:
                fontSize: '16px',
                color: "#32325d",
            }
        };

        // Create an instance of the card Element.
        var card = elements.create('card', {
            style: style
        });

        // Add an instance of the card Element into the `card-element` <div>.
        card.mount('#card-element');

        var form = document.getElementById('payment-form');
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            stripe.createToken(card).then(function(result) {
                if (result.error) {
                    // Inform the customer that there was an error.
                    var errorElement = document.getElementById('card-errors');
                    errorElement.textContent = result.error.message;
                } else {
                    // Send the token to your server.
                    stripeTokenHandler(result.token);
                }
            });
        });

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
    </section>

</div>
@endsection