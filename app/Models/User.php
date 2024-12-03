<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    // Numele tabelului asociat modelului
    protected $table = 'users';

    // Câmpurile care pot fi completate în mod masiv
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    // Ascunde parola în serializări
    protected $hidden = [
        'password',
    ];
    // Relația cu recenziile
    public function reviews()
    {
        return $this->hasMany(Review::class, 'user_id', 'id');
    }
}
