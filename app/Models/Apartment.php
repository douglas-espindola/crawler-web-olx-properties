<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;

    protected $fillable = [
        'link',
        'price',
        'bedrooms',
        'city',
        'neighborhood'
    ];

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

}
