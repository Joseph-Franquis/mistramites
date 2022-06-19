<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Publicaciones;
use App\Models\Usuarios;


class PublicacionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $usuarios = Usuarios::all();
        $usuarios->each(function($usuario) {
            Publicaciones::factory()->count(3)->create([
                'usuario_id' => $usuario->id
            ]);
        });
    }
}
