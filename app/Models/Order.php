<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'user_id',
        'order_number',
        'total_amount',
        'shipping_cost',
        'status'
    ];
    
    /**
     * Relasi ke User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

     public function orderDetails()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }

    /**
     * Relasi ke OrderItems
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Badge warna status
     */
    public function getStatusColorAttribute()
    {
        return [
            'pending' => 'warning',
            'processing' => 'info',
            'shipped' => 'primary',
            'delivered' => 'success',
            'cancelled' => 'danger',
        ][$this->status] ?? 'secondary';
    }
}