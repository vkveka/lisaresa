<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'image',
        'accomodation_id',
    ];

    public function accomodation()
    {
        return $this->belongsTo(Accomodation::class);
    }
}
