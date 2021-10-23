<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Citas extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_cita';
    protected $fillable = [
        'id_especialidad',
        'id_medico',
        'id_horario',
        'nomb_usuario'
    ];
}
