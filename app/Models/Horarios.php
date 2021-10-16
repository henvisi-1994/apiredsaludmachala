<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Horarios extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_horario';
    protected $fillable = [
        'fecha',
        'id_hora',
        'id_medico',
    ];
}
