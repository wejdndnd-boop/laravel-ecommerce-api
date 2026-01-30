<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_price',
        'status', // pending, paid, cancelled (metel ma matloub)
    ];

    /**
     * Relationship: El Order belongs to a User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship: El Order has many Items (Requirement #4).
     */
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}