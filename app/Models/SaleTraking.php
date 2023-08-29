<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SaleTraking extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'details',
        'date',
    ];

    protected $casts = [
        'date' => 'datetime'
    ];

    //relationships
    public function sale(): HasOne
    {
        return $this->hasOne(Sale::class);
    }
}
