<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarea extends Model
{
    use HasFactory;
    protected $table = 'tareas';

    //Definir los campos
    protected $fillable = [
        'nombre',
        'descripcion',
        'materia',
        'fecha_entrega',
    ];
}
