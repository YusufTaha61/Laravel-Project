<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'name', 
        'email', 
        'phone', 
        'address', 
        'city', 
        'country', 
        'zip_code',
        'subtotal', 
        'shipping_price', 
        'total', 
        'shipping_method', 
        'payment_method', 
        'status'
    ];

    public const STATUSES = ['New', 'Accepted', 'Cancelled', 'Onshipping', 'Completed'];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}