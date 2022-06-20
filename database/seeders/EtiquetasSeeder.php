<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Etiquetas;

class EtiquetasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $creator = new Etiquetas();
        $creator->nombre = 'BOE';
        $creator->descripcion = 'Subido: activo para que los usuarios lo puedan vizualizar';
        $creator->save();

        $creator = new Etiquetas();
        $creator->nombre = 'Educativo';
        $creator->descripcion = 'Revisado: listo para subir y ser visto por el publico';
        $creator->save();

        $creator = new Etiquetas();
        $creator->nombre = 'Extranjeria';
        $creator->descripcion = 'Rechazado: la publicacion se ha rechazado por un problema';
        $creator->save();

        $creator = new Etiquetas();
        $creator->nombre = 'Autonomos';
        $creator->descripcion = 'Pendiente: la publicacion debe ser revisada para ver el cumplimiento de los estandares';
        $creator->save();

    }
}
