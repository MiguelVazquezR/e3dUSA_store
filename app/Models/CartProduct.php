<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class CartProduct extends Pivot
{
    use HasFactory;

    public $incrementing = true;

    protected $fillable = [
        'quantity',
        'cart_id',
        'product_id',
    ];

    //relationships
    public function product() :BelongsTo
    {
        return $this->belongsTo(Product::class);

    }

    public function cart() :BelongsTo
    {
        return $this->belongsTo(Cart::class);

    }
}
