<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Noticias extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_noticia';
    protected $fillable = [
        'titulo_noticia',
        'imagen_noticia',
        'descripcion_noticia',
    ];
}
