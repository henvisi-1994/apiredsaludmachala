<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CentrosMedicos extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_centroMedico';
    protected $fillable = [
        'nombre_centroMedico',
        'direccion_centroMedico',
        'telef_centroMedico',
        'ubic_centroMedico',
        'email',
    ];
}
