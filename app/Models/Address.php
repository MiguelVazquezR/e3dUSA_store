<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'address',
        'city',
        'state',
        'country',
        'postal_code',
        'receiver_name',
        'phone',
        'user_id',
    ];

    //relationships 
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
