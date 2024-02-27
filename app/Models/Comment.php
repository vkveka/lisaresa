<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'accomodation_id',
        'content',
        'title',
        'note',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function accomodation()
    {
        return $this->belongsTo(Accomodation::class);
    }
}
