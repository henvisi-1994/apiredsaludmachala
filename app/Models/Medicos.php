<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicos extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_medico';
    protected $fillable = [
        'nombre_medico',
        'tipo_medico',
        'id_detalleCentroMed',

    ];
    public function detalle()
    {
        return $this->hasOne(DetalleCentrosMedicos::class, 'id_detalleCentroMed', 'id_detalleCentroMed')->with('centro_medico','especialidad');
    }
}
