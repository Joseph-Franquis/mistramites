<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Estados;

class EstadosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $creator = new Estados();
        $creator->nombre = 'Subido';
        $creator->descripcion = 'Subido: activo para que los usuarios lo puedan vizualizar';
        $creator->save();

        $creator = new Estados();
        $creator->nombre = 'Revisado';
        $creator->descripcion = 'Revisado: listo para subir y ser visto por el publico';
        $creator->save();

        $creator = new Estados();
        $creator->nombre = 'Rechazado';
        $creator->descripcion = 'Rechazado: la publicacion se ha rechazado por un problema';
        $creator->save();

        $creator = new Estados();
        $creator->nombre = 'Pendiente';
        $creator->descripcion = 'Pendiente: la publicacion debe ser revisada para ver el cumplimiento de los estandares';
        $creator->save();

        $creator = new Estados();
        $creator->nombre = 'Editando';
        $creator->descripcion = 'Editando: la publicacion se esta editando para tener el mejor contenido';
        $creator->save();
    }
}
