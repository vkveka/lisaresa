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

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function options()
    {
        return $this->belongsToMany(Option::class, 'accomodation_options');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function favoris()
    {
        return $this->belongsToMany(User::class, 'favoris');
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
