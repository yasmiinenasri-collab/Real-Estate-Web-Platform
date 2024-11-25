@extends('layouts.app')

@section('content')
<div class="container d-flex justify-content-center align-items-center vh-100">
    <div class="card shadow-sm p-4" style="max-width: 400px; width: 100%;">
        <h2 class="card-title mb-4 text-center">Paiement pour {{ $immeuble->name }}</h2>
        <form id="payment-form">
            <div id="card-element" class="mb-3"></div>
            <button id="submit" class="btn btn-primary w-100">Payer {{ number_format($immeuble->price, 2) }} TND</button>
            <div id="payment-message" class="mt-3 text-danger"></div>
        </form>
    </div>
</div>

<script src="https://js.stripe.com/v3/"></script>
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
                    name: 'Client',
                },
            }
        });

        if (error) {
            document.getElementById('payment-message').textContent = error.message;
        } else {
            if (paymentIntent.status === 'succeeded') {
                // Redirige après le succès du paiement
                window.location.href = "{{ route('completePayment') }}";
            }
        }
    });
</script>
@endsection
