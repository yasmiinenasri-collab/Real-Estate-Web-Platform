<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paiement</title>
    <script src="https://js.stripe.com/v3/"></script>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f8f9fa;
            margin: 0;
        }
        #payment-form {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        #card-element {
            margin-bottom: 20px;
        }
        #submit {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }
        #submit:hover {
            background-color: #0056b3;
        }
        #payment-message {
            margin-top: 10px;
            color: #d9534f; /* Red color for error messages */
        }
    </style>
</head>
<body>
    <form id="payment-form">
        <h2>Paiement</h2>
        <div id="card-element"></div>
        <button id="submit">Payer</button>
        <div id="payment-message"></div>
    </form>

    <script>
        var stripe = Stripe('{{ config('services.stripe.key') }}');
        var elements = stripe.elements();
        var cardElement = elements.create('card');
        cardElement.mount('#card-element');

        var form = document.getElementById('payment-form');
        form.addEventListener('submit', async function(event) {
            event.preventDefault();
            var {paymentIntent, error} = await stripe.confirmCardPayment('{{ $client_secret }}', {
                payment_method: {
                    card: cardElement,
                    billing_details: {
                        name: 'Customer',
                    },
                }
            });

            if (error) {
                document.getElementById('payment-message').textContent = error.message;
            } else {
                if (paymentIntent.status === 'succeeded') {
                    document.getElementById('payment-message').textContent = 'Payment successful!';
                }
            }
        });
    </script>
</body>
</html>
