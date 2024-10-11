<x-app-layout>
    <style>
        .StripeElement {
            box-sizing: border-box;
            height: 40px;
            padding: 10px 12px;
            border: 1px solid transparent;
            border-radius: 4px;
            background-color: white;
            box-shadow: 0 1px 3px 0 #e6ebf1;
            transition: box-shadow 150ms ease;
        }

        .StripeElement--focus {
            box-shadow: 0 1px 3px 0 #cfd7df;
        }

        .StripeElement--invalid {
            border-color: #fa755a;
        }

        .StripeElement--webkit-autofill {
            background-color: #fefde5 !important;
        }
    </style>
    <div
        class="max-w-7xl mx-auto py-12 mt-12 px-8 bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg text-gray-900 dark:text-gray-100">
        <h2 class="dark:text-gray-100 text-gray-900 font-semibold py-5 text-3xl">Stripe Payment</h2>
        <p class="text-xl dark:text-gray-100 text-gray-900 font-semibold">Charge : $9 <span
                class="text-base dark:text-gray-100 text-gray-900">You will get 10 credit</span></p>
        <form id="payment-form" method="POST" action="{{ route('stripe.payment') }}">
            @csrf
            <div class="flex flex-col gap-5">
                <label for="card-element" class="dark:text-gray-100 text-gray-900 font-semibold">
                    Credit or debit card
                </label>

                <div id="card-element" class="max-w-xl">
                </div>
                <div id="card-errors" role="alert"></div>
            </div>
            <button
                class="px-6 font-medium py-2 rounded-md text-gray-100 bg-gray-900 hover:bg-gray-800 border-2 duration-300 border-indigo-600"
                id="submit-button">Submit
                Payment</button>
        </form>
    </div>

    <!-- Stripe.js -->
    <script src="https://js.stripe.com/v3/"></script>
    <script>
        var stripe = Stripe('{{ config('services.stripe.publish_key') }}');
        var elements = stripe.elements();

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

        var card = elements.create('card', {
            style: style
        });
        card.mount('#card-element');

        card.on('change', function(event) {
            var displayError = document.getElementById('card-errors');
            if (event.error) {
                displayError.textContent = event.error.message;
            } else {
                displayError.textContent = '';
            }
        });

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

</x-app-layout>
