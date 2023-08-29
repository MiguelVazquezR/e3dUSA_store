<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Discount extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'is_percentage',
        'discount',
        'expire_date',
    ];

    protected $casts = [
        'expire_date' => 'date'
    ];

    //relationships
    public function sales(): HasMany
    {
        return $this->hasMany(Sale::class);
    }
}
