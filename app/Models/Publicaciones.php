<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publicaciones extends Model
{
    use HasFactory;
    public function usuario()
    {
        return $this->belongsTo('App\Models\Usuarios');
    }
    public function estado()
    {
        return $this->belongsTo('App\Models\Estado');
    }
}
