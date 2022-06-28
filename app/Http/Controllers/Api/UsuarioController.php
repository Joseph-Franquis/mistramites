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
        $usuario = Usuarios::find($id);
        $tablas = [
            'id' => $usuario->id,
            'usuario' => $usuario->usuario,
            'contenido' => $usuario->nombre,
            'correo' => $usuario->correo,
            'rol' => $usuario->rol,
            'created_at' => $usuario->created_at,
            'img' => $usuario->img,
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

    //Register a new user and save it in the database
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

    // Start a session for the first time and return its id

    public function login(Request $request){
        //save the session id in a variable
        $id_session = $request->id_session."";
        //returns the session data from the database
        $session = $this->showSesion($request->id_session);
        $json = json_decode($session->payload);
        //check if the session token is equal to the one sent by parameter
        if($json->token === $request->token){
            //We look for the user by email
            $usuario = Usuarios::where('correo',$request->correo)->first();
            //check if the password is the same as the one in the database
            if(password_verify($request->password, $usuario->password)){
                //we create a new token
                $usuario->remember_token = bin2hex(openssl_random_pseudo_bytes(24));
                //we save the new value of the session
                $json = json_decode($session->payload);
                $json->token = $usuario->remember_token;
                $json = json_encode($json);
                //we update the session values
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

    // This function starts the session for the first time, returning its id
    public function firstSesion(Request $request){
        $id_session = bin2hex(openssl_random_pseudo_bytes(30));
        $this->startSesion($id_session);
        return response()->json($id_session, 200);
    }

}
