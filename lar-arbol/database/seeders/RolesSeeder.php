<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Roles;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $admin = new Roles();
        $admin->nombre = 'Administrador';
        $admin->descripcion = 'Administrador de la Pagina';
        $admin->save();

        $moderator = new Roles();
        $moderator->nombre = 'Moderador';
        $moderator->descripcion = 'Modera, Supervisa y Controla las acciones de los usuarios registrados';
        $moderator->save();

        $creator = new Roles();
        $creator->nombre = 'Creador';
        $creator->descripcion = 'Crea las publicaciones de los usuarios que ven';
        $creator->save();

        $creator = new Roles();
        $creator->nombre = 'Usuario';
        $creator->descripcion = 'Usuario Comun';
        $creator->save();

        $creator = new Roles();
        $creator->nombre = 'Visitante';
        $creator->descripcion = 'Visitante de la pagina';
        $creator->save();
    }
}
