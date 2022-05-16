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
    public function centro_medico()
    {
        return $this->hasOne(CentrosMedicos::class,'id_centroMedico','id_centroMedico');
    }
    public function especialidad()
    {
        return $this->hasOne(Especialidades::class,'id_especialidad','id_especialidad');
    }

}
