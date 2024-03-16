<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Foto extends Model
{
    use HasFactory;

    protected $table = 'fotos'; // Nombre de la tabla en la base de datos

    protected $fillable = [
        'id', 'clave', 'cat', 'colores', 'nombre', 'text', 'bpday'
    ];
}
