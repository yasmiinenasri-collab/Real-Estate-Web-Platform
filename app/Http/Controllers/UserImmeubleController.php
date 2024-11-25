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
    
        // Recherche par ville
        if ($request->has('search') && !empty($request->input('search'))) {
            $search = $request->input('search');
            $query->where('ville', 'like', "%{$search}%");
        }
    
        // Filtrer par prix minimum
        if ($request->has('price_min') && is_numeric($request->input('price_min'))) {
            $price_min = (float) $request->input('price_min');
            $query->where('price', '>=', $price_min);
        }
    
        // Filtrer par prix maximum
        if ($request->has('price_max') && is_numeric($request->input('price_max'))) {
            $price_max = (float) $request->input('price_max');
            $query->where('price', '<=', $price_max);
        }
    
        // Filtrer par nombre de chambres
        if ($request->has('rooms') && is_numeric($request->input('rooms'))) {
            $rooms = (int) $request->input('rooms');
            $query->where('rooms', '>=', $rooms);
        }
    
        // Tri des résultats
        if ($request->has('sort')) {
            $sort = $request->input('sort');
            if ($sort == 'price_asc') {
                $query->orderBy('price', 'asc');
            } elseif ($sort == 'price_desc') {
                $query->orderBy('price', 'desc');
            }
        }
    
        // Pagination des résultats
        $immeubles = $query->paginate(6); // 6 immeubles par page
        return view('index', compact('immeubles'));
    }
    

    public function reserve($id)
    {
        $immeuble = Immeuble::find($id);
    
        if ($immeuble) {
            $client_secret = $this->createPaymentIntent($immeuble->price * 100); // Le prix doit être en centimes
    
            return view('paymentForm', [
                'immeuble' => $immeuble,
                'client_secret' => $client_secret,
            ]);
        }
    
        return redirect()->route('user.immeubles.index')->with('error', 'Property not found!');
    }

    public function completePayment()
    {
        return view('completePayment'); // Assure-toi que la vue existe
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
