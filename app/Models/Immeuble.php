<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Immeuble extends Model
{
    use HasFactory;
    protected $table = 'immeubles';
    protected $fillable = [
        'name', 'address', 'price', 'description', 'picture', 'rooms', 
        'toilets', 'heating', 'air_conditioning', 'ville', 'transaction_type', 'status'
    ];

    protected $casts = [
        'air_conditioning' => 'boolean',
        'heating' => 'boolean',
    ];

    protected $attributes = [
        'transaction_type' => 'a_vendre', // valeur par défaut
        'status' => 'disponible' // valeur par défaut
    ];
    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }
}
