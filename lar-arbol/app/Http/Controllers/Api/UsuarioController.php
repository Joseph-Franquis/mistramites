<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuarios;
use Illuminate\Support\Facades\DB;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $usuarios = Usuarios::find($id);
        $tablas = array();
        foreach ($usuarios as $key => $value) {
            $tablas[$key]['usuario'] = $value->usuario;
            $tablas[$key]['nombre'] = $value->nombre;
            $tablas[$key]['correo'] = $value->correo;
            $tablas[$key]['creado'] = $value->created_at;
            $tablas[$key]['actualizado'] = $value->updated_at;

        }
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

    public function register(Request $request){
        $session = $this->showSesion($request->id_session);
        $json = json_decode($session->payload);
        if($json->token === $request->token){
            $usuario = new Usuarios();
            $usuario->usuario = $request->usuario;
            $usuario->nombre = $request->nombre;
            $usuario->correo = $request->correo;
            $usuario->password = password_hash( $request->password,PASSWORD_BCRYPT);
            $usuario->usuario_rol = 4;
            //$usuario->remember_token = bin2hex(openssl_random_pseudo_bytes(24));
            $usuario->save();
            return response()->json(["Registro Completado"], 200);
        }else{
            return response()->json(array(
                "No autorizado" => "401"
            ), 401);
        }

    }

    public function login(Request $request){
        //guarda en una variable el id de sesion
        $id_session = $request->id_session."";
        // $this->startSesion($request->id_session);
        //devuelve del base de datos los datos de la sesion
        $session = $this->showSesion($request->id_session);
        $json = json_decode($session->payload);
        //comprueba si el token de la sesion es igual al enviado por parametro
        if($json->token === $request->token){
            //buscamos el usuario por  el correo
            $usuario = Usuarios::where('correo',$request->correo)->first();
            //comprobamos si la contraseña es igual a la
            if(password_verify($request->password, $usuario->password)){
                //creamos un nuevo token
                $usuario->remember_token = bin2hex(openssl_random_pseudo_bytes(24));
                //guardamos el nuevo valor de la sesion
                $json = json_decode($session->payload);
                $json->token = $usuario->remember_token;
                $json = json_encode($json);
                //actualizamos los valores de la sesion
                $this->updateSesion($request->id_session ,['payload' => $json]);
                $tablas = array();
                $tablas["token"] = $usuario->remember_token;
                $tablas["rol"] = $usuario->usuario_rol;
                $tablas["id"] = $usuario->id;
                $usuario->update();
                return response()->json($tablas, 200);
            }else{
                return response()->json(array(
                    "Contraseña o Correo Incorrectos" => "401"
                ), 401);
            }
        }else{
            return response()->json(array(
                "No autorizado" => "401"
            ), 401);
        }
    }

    //esta funcion inicia por primera vez la sesion devlviendo el id de esta
    public function firstSesion(Request $request){
        $id_session = bin2hex(openssl_random_pseudo_bytes(30));
        $this->startSesion($id_session);
        return response()->json($id_session, 200);
    }

}
