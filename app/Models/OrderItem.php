<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    // Dökümanda belirtilen doldurulabilir veritabanı alanları
    protected $fillable = [
        'order_id',
        'product_id',
        'product_title',
        'price',
        'quantity',
        'total',
    ];

    // Sipariş ile olan belongsTo ilişkisi
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // Ürün ile olan belongsTo ilişkisi
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}