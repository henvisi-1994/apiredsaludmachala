<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CalificacionApp extends Model
{
    use HasFactory;
    protected $table = 'calificacion';
    protected $primaryKey = 'id_calificacion';
    protected $fillable = [
        'id_cita',
        'calificacion',
        'comentario',
    ];
}
