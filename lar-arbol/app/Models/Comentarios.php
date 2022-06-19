<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comentarios extends Model
{
    use HasFactory;
    public function usuarios()
    {
        return $this->belongsTo('App\Models\Usuarios', 'id', 'usuario_id');
    }
    public function publicaciones()
    {
        return $this->hasMany('App\Models\Publicaciones','id','publicacion_id');
    }
}
