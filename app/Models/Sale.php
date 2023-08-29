<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'total',
        'payment_method',
        'cart_id',
        'discount_id',
        'sent_at',
        'sale_traking_id',
        'shipping_id',
    ];

    protected $casts = [
        'sent_at' => 'datetime'
    ];

    //relationships
    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }

    public function shipping(): BelongsTo
    {
        return $this->belongsTo(Shipping::class);
    }

    public function discount(): HasOne
    {
        return $this->hasOne(Discount::class);
    }

    public function saleTraking(): BelongsTo
    {
        return $this->belongsTo(SaleTraking::class);
    }


}
