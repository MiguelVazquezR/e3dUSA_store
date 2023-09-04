<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'bank_name',
        'account_number',
        'owner_name',
        'is_default',
        'user_id',
    ];

    //relationships
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
