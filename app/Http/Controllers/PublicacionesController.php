<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//uso de modelo para conexion con base de datos
use App\Models\Publicaciones;
use App\Models\Usuarios;
use App\Models\Estados;

class PublicacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $publicaciones = Publicaciones::get();
        $tablas = [];
        $rows = [];
        foreach ($publicaciones as $key => $value) {
            $rows[$key]['id'] = $value->id;
            $rows[$key]['titulo'] = $value->titulo;
            $rows[$key]['contenido'] = $value->contenido;
            $usuario = Usuarios::find($value->usuario_id);
            $rows[$key]['usuario'] = $usuario->usuario;
            $rows[$key]['creado'] = $value->created_at;
            $rows[$key]['actualizado'] = $value->updated_at;

        }
        $tablas["rows"] = $rows;
        // $tablas["token"] = ;
        // var_dump($tablas);
        return response()->json($tablas, 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $publicacion = Publicaciones::find($id);
        $usuario = Usuarios::find($publicacion->usuario_id);
        $tablas = [
            'id' => $publicacion->id,
            'titulo' => $publicacion->titulo,
            'contenido' => $publicacion->contenido,
            'usuario' => $usuario->usuario,
            'actualizado' => $publicacion->updated_at,
        ];
        return response()->json($tablas, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
