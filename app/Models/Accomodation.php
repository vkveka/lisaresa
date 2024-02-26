<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accomodation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'type',
        'price',
        'dispo',
        'address',
        'cp',
        'city',
        'country',
        'superficy',
        'rooms',
        'beds',
        'persons',
        'note',
    ];
}
