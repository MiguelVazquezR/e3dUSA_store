<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'patern_last_name',
        'mother_last_name',
        'rfc',
        'tax_regime',
        'cfdi_use',
        'postal_code',
        'street',
        'outdoor_number',
        'interior_number',
        'colony',
        'city_halll',
        'city',
        'state',
        'email',
        'phone',
        'user_id',
    ];

    //relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
