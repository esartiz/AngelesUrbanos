<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrito extends Model
{
    use HasFactory;
    protected $table = 'carritos'; // Nombre de la tabla en la base de datos

    protected $fillable = [
        'ipUser', 'prod', 'cnt', 'total', 'fecha', 'status'
    ];
}
