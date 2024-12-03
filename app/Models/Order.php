<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // Numele tabelului asociat cu modelul
    protected $table = 'orders';

    // Câmpurile care pot fi completate prin metode de tip mass-assignment
    protected $fillable = [
        'user_id',
        'status',
        'order_date',
    ];

    // Activarea timpelor pentru created_at și updated_at
    public $timestamps = true;

    // Relația cu utilizatorul
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // Relația cu articolele din comandă
    public function items()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }
}
