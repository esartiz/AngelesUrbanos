<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customers'; // Nombre de la tabla en la base de datos

    protected $fillable = [
        'nombre', 'documento', 'direccion', 'pais', 'estado', 'ciudad', 'barrio', 'correo', 'telefono', 'idCart', 'pedido', 'track'
    ];
}
