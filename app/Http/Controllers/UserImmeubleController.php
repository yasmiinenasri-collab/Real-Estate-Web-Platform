<?php

namespace App\Http\Controllers;

use App\Models\Immeuble;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;

class UserImmeubleController extends Controller
{
    public function index(Request $request)
    {
        $query = Immeuble::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where('ville', 'like', "%{$search}%");
        }

        $immeubles = $query->get();
        return view('index', compact('immeubles'));
    }

    public function reserve($id)
    {
        $immeuble = Immeuble::find($id);

        if ($immeuble) {
            $amount = $immeuble->price * 100; // En centimes
            return view('payment', [
                'client_secret' => $this->createPaymentIntent($amount),
                'immeuble_id' => $id
            ]);
        }

        return redirect()->route('index')->with('error', 'Property not found!');
    }

    protected function createPaymentIntent($amount)
    {
        Stripe::setApiKey(config('services.stripe.secret'));

        $paymentIntent = PaymentIntent::create([
            'amount' => $amount,
            'currency' => 'eur',
            'payment_method_types' => ['card'],
        ]);

        return $paymentIntent->client_secret;
    }

    public function processPayment(Request $request)
    {
        $paymentIntentId = $request->input('payment_intent');
        $immeubleId = $request->input('immeuble_id');

        Stripe::setApiKey(config('services.stripe.secret'));

        try {
            $paymentIntent = PaymentIntent::retrieve($paymentIntentId);

            if ($paymentIntent->status === 'succeeded') {
                $immeuble = Immeuble::find($immeubleId);
                if ($immeuble) {
                    $immeuble->status = 'reserved';
                    $immeuble->save();

                    return view('completePayment');
                }
            }
        } catch (\Exception $e) {
            return redirect()->route('index')->with('error', 'Payment verification failed: ' . $e->getMessage());
        }

        return redirect()->route('index')->with('error', 'Property not found or payment failed!');
    }
}
