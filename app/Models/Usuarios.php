<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;

class Usuarios extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    protected $table = 'usuarios';

     // Campos que podem ser preenchidos
    protected $fillable = [
        'nome',
        'email',
        'senha',
    ];

    // Campos ocultos quando convertido pra JSON
    protected $hidden = [
        'senha',
        'remember_token',
    ];

    // Transforma campos automaticamente
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'senha' => 'hashed',
        ];
    }

    

}
