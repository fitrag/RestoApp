<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'discount_type',
        'discount_value',
        'minimum_order',
        'valid_until',
        'usage_limit',
        'used_count',
    ];

    // Scope untuk memeriksa apakah kupon masih valid
    public function scopeValid($query)
    {
        return $query->where('valid_until', '>=', now())
                     ->where(function ($q) {
                         $q->whereNull('usage_limit')
                           ->orWhere('used_count', '<', 'usage_limit');
                     });
    }
}
