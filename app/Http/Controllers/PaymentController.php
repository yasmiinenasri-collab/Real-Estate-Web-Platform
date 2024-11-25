<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\PaymentIntent;
use App\Models\Immeuble;
use App\Models\Payment;

class PaymentController extends Controller
{
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
                    // Mettez à jour le statut de l'immeuble
                    $immeuble->status = 'reserved';
                    $immeuble->save();
    
                    // Enregistrez les informations du paiement
                    Payment::create([
                        'payment_intent_id' => $paymentIntent->id,
                        'immeuble_id' => $immeuble->id,
                        'amount' => $immeuble->price, // Assurez-vous que le prix est bien défini dans le modèle Immeuble
                    ]);
    
                    return redirect()->route('index')->with('success', 'Reservation and payment successful!');
                }
            }
        } catch (\Exception $e) {
            return redirect()->route('index')->with('error', 'Payment verification failed: ' . $e->getMessage());
        }
    
        return redirect()->route('index')->with('error', 'Property not found or payment failed!');
    }
}
