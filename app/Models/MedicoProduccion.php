<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MedicoProduccion extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_medico_prod';
    protected $fillable = [
        'nomb_medico',
        'id_especialidad',
    ];
}
