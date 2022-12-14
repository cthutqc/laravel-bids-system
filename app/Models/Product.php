<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'optimal_price', 'blitz_price'];

    public function user():BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function bids():HasMany
    {
        return $this->hasMany(Bid::class);
    }
}
