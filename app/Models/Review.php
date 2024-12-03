<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    // Numele tabelului asociat modelului
    protected $table = 'reviews';

    // Câmpurile care pot fi completate în mod masiv
    protected $fillable = ['product_id', 'user_id', 'rating', 'comment', 'review_date'];

    // Relația cu produsul
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}