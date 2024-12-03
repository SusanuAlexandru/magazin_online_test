<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // Numele tabelului asociat modelului
    protected $table = 'products';

    // Câmpurile care pot fi completate în mod masiv
    protected $fillable = [
        'image',
        'name',
        'description',
        'price',
        'stock',
        'brand',
        'category_id'
    ];

    // Relația cu categoria
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
   // Relația cu recenziile
    public function reviews()
    {
        return $this->hasMany(Review::class, 'product_id', 'id');
    }

}
