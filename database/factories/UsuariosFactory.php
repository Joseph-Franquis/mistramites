<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Usuarios;

class UsuariosFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->unique()->word();
        return [
            'usuario' => $name,
            'nombre' => $name.' '.$this->faker->word(),
            'correo' => $name."@hotmail.com",
            'password' => password_hash($name, PASSWORD_BCRYPT),
            'usuario_rol' => 1,
        ];
    }
}
