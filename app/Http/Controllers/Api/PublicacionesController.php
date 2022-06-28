<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Publicaciones;
use App\Models\Usuarios;
use App\Models\Estados;

class PublicacionesController extends Controller
{
    /**
     * Controller to List All Posts
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
            $tablas[$key]['id'] = $value->id;
            $tablas[$key]['titulo'] = $value->titulo;
            $tablas[$key]['contenido'] = $value->contenido;
            $usuario = Usuarios::find($value->usuario_id);
            $tablas[$key]['usuario'] = $usuario->usuario;
            $tablas[$key]['creado'] = $value->created_at;
            $tablas[$key]['actualizado'] = $value->updated_at;

        }
        return response()->json($tablas, 200);
    }

    /**
     * Create a new post
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $session = $this->showSesion($request->id_session);
        if($session != null){
            $json = json_decode($session->payload);
            if($json->token == $request->token){
                $usuario = Usuarios::where('id',$request->usuario)->first();
                // var_dump($usuario);
                if($usuario){
                    if($usuario->usuario_rol == 1 || $usuario->usuario_rol == 3){
                        $publicacion = new Publicaciones;
                        $publicacion->titulo = $request->titulo;
                        $publicacion->usuario_id= $usuario->id;
                        $publicacion->estado_id = 5;
                        $publicacion->contenido = $request->contenido;
                        $publicacion->save();
                        return response()->json(array(
                            "action" => "mesage",
                            "msg" => "Se ha guardado correctamente"
                        ), 200);
                    }
                }else{
                    return response()->json(array(
                        "Algo a pasado" => "500"
                    ), 500);
                }
            }else{
                return response()->json(array(
                    "No autorizado" => "Token invalido"
                ), 401);
            }
        }else{
            return response()->json(array(
                "No autorizado" => "Token inexistente"
            ), 401);
        }
    }

    /**
     * Controller to display a post
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

    /**
     * list the publications that each of all users has if the role is admin or
     * list the publications of a user to manage them
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function indexGestion(Request $request)
    {
        $session = $this->showSesion($request->id_session);
        if($session != null){
            $json = json_decode($session->payload);
            if($json->token === $request->token){
                $usuario = Usuarios::where('id',$request->id_user)->first();
                if($usuario){
                    switch ($usuario->usuario_rol) {
                        case 1:
                            $publicaciones = Publicaciones::get();
                            $tablas = array();
                            foreach ($publicaciones as $key => $value) {
                                $tablas[$key]['id'] = $value->id;
                                $tablas[$key]['titulo'] = $value->titulo;
                                $tablas[$key]['contenido'] = $value->contenido;
                                $usuario_pub = Usuarios::find($value->usuario_id);
                                $tablas[$key]['usuario'] = $usuario_pub->usuario;
                                $estado = Estados::find($value->estado_id);
                                $tablas[$key]['estado'] = $estado->nombre;
                                $tablas[$key]['creado'] = $value->created_at;
                                $tablas[$key]['actualizado'] = $value->updated_at;
                            }
                            return response()->json($tablas, 200);
                            break;

                        case 3:
                            $publicaciones = Publicaciones::where("usuario_id", $usuario->id)->orderBy('created_at', 'desc')->get();
                            $tablas = array();
                            foreach ($publicaciones as $key => $value) {
                                $tablas[$key]['id'] = $value->id;
                                $tablas[$key]['titulo'] = $value->titulo;
                                $tablas[$key]['contenido'] = $value->contenido;
                                $tablas[$key]['usuario'] = $usuario->usuario;
                                $tablas[$key]['creado'] = $value->created_at;
                                $tablas[$key]['actualizado'] = $value->updated_at;
                            }

                            return response()->json($tablas, 200);
                            break;

                        default:

                            break;
                    }
                }else{
                    return response()->json(array(
                        "Algo a pasado" => "500"
                    ), 500);
                }

            }else{
                return response()->json(array(
                    "No autorizado" => "Token invalido"
                ), 401);
            }
        }else{
            return response()->json(array(
                "No autorizado" => "Token inexistente"
            ), 401);
        }
    }

    /**
     * Controller to show the posts with the filters that were passed and search for a post with those matches
     *
     * @return \Illuminate\Http\Response
     */
    public function buscador(Request $request){
        $publicaciones = Publicaciones::where('titulo','like','%'.$request->texto.'%')
            ->orWhere('contenido','like','%'.$request->texto.'%');
        $etiquetas;
        if(isset($request->etiquetas)){
            $etiquetas = explode(",", $request->etiquetas);
            $publicaciones->join('etiqueta_publicacion', 'publicaciones.id', '=', 'etiqueta_publicacion.publicacion_id');
            $publicaciones->join('etiquetas', 'etiqueta_publicacion.etiqueta_id', '=', 'etiquetas.id');
            foreach ($etiquetas as $key => $value) {
                if(strlen($value) > 0){
                    $publicaciones->Where('etiquetas.id','=',$value);
                }

            }
        }
        $publicaciones = $publicaciones->get();
        $tablas = array();
        foreach ($publicaciones as $key => $value) {
            $tablas[$key]['id'] = $value->id;
            $tablas[$key]['titulo'] = $value->titulo;
            $tablas[$key]['contenido'] = $value->contenido;
            // $usuario_pub = Usuarios::find($value->usuario_id);
            $tablas[$key]['usuario'] = $value->usuario_id;
            $tablas[$key]['creado'] = $value->created_at;
            $tablas[$key]['actualizado'] = $value->updated_at;
        }

        return response()->json($tablas, 200);
    }

        /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function carusel()
    {
        //
        $publicaciones = Publicaciones::paginate(5);
        $tablas = [];
        $rows = [];
        foreach ($publicaciones as $key => $value) {
            $tablas[$key]['id'] = $value->id;
            $tablas[$key]['titulo'] = $value->titulo;
            $tablas[$key]['contenido'] = $value->contenido;
            $usuario = Usuarios::find($value->usuario_id);
            $tablas[$key]['usuario'] = $usuario->usuario;
            $tablas[$key]['creado'] = $value->created_at;
            $tablas[$key]['actualizado'] = $value->updated_at;

        }
        return response()->json($tablas, 200);
    }
}
