<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'features',
        'price',
        'is_percentage',
        'discount',
    ];

    protected $casts = [
        'features' => 'array'
    ];

    //relationships
    public function carts() :BelongsToMany
    {
        return $this->belongsToMany(Cart::class)
            ->using(CartProduct::class)
            ->withPivot([
                'id',
                'quntity',
            ])
            ->withTimestamps();
    }
}
