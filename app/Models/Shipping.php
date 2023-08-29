<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Shipping extends Model
{
    use HasFactory;

    protected $fillable = [
        'address',
        'user_name',
        'phone',
        'city',
        'state',
        'country',
        'postal_code',
        'delivered_at',
    ];

    protected $casts = [
        'delivered_at' => 'datetime'
    ];

    //relationships
    public function sale(): HasOne
    {
        return $this->hasOne(Sale::class);
    }

}
