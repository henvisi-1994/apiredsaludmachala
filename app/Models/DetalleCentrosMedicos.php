<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleCentrosMedicos extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_detalleCentroMed';
    protected $fillable = [
        'id_centroMedico',
        'id_especialidad',

    ];
}
