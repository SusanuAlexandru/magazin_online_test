<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    // Numele tabelului asociat cu acest model
    protected $table = 'categories';

    // Câmpurile care pot fi completate prin metode de tip mass-assignment
    protected $fillable = ['name'];

    // Activarea timpelor pentru created_at și updated_at
    public $timestamps = true;

    // Relația cu produsele
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }
   
}
