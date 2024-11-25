<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Payment extends Model
{

    use HasFactory;
    protected $fillable = [
        'payment_intent_id', 'immeuble_id', 'amount',
    ];

    // Définir la relation avec le modèle Immeuble si nécessaire
    public function immeuble()
    {
        return $this->belongsTo(immeuble::class);
    }
}
