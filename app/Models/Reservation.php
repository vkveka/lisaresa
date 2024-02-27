<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'accomodation_id',
        'date_in',
        'date_out',
        'numero',
        'price',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payment()
    {
        // Il n'y a qu'un seul paiement par réservation. Si plusieurs : hasMany()
        return $this->hasOne(Payment::class);
    }

    public function accomodation()
    {
        return $this->belongsTo(Accomodation::class);
    }
}
