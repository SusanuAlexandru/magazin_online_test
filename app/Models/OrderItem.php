<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    // Numele tabelului asociat cu modelul
    protected $table = 'order_items';

    // Câmpurile care pot fi completate prin metode de tip mass-assignment
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
    ];

    // Activarea timpelor pentru created_at și updated_at
    public $timestamps = true;

    // Relația cu comanda
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    // Relația cu produsul
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
