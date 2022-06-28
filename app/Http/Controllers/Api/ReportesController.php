<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reportes;
use App\Models\Usuarios;
use App\Models\ReporteU;

class ReportesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tablas = array();
        // $reportes = ReporteU::get();
        // // var_dump($reportes);
        // $session = $this->showSesion($request->id_session);
        // if($session != null){
        //     $json = json_decode($session->payload);
        //     if($json->token === $request->token){
        //         $usuario = Usuarios::where('id',$request->id_user)->first();
        //         if($usuario){
        //             if($usuario->usuario_rol == 1 || $usuario->usuario_rol == 2){
        //                 $reportes = ReporteU::get();

        //                 foreach ($reportes as $key => $value) {
        //                     $tablas[$key]['id'] = $value->id;
        //                     $tablas[$key]['descripcion'] = $value->descripcion;
        //                     $tablas[$key]['creado'] = $value->created_at;

        //                     $usuario = Usuarios::find($value->usuario);
        //                     $tablas[$key]['usuario'] = $usuario->usuario;

        //                     $usuario = Usuarios::find($value->usuario_reportado);
        //                     $tablas[$key]['reportado'] = $usuario->usuario_reportado;

        //                     $reporte = Reportes::find($value->reporte_tipo);
        //                     $tablas[$key]['reportado'] = $reporte->descripcion;
        //                 }
        //             }else{
        //                 return response()->json(array(
        //                     "Su rol no le permite acceder a esta pagina" => "401"
        //                 ), 401);
        //             }
        //         }else{
        //             return response()->json(array(
        //                 "Algo a pasado" => "500"
        //             ), 500);
        //         }
        //     }else{
        //         return response()->json(array(
        //             "No autorizado" => "Token invalido"
        //         ), 401);
        //     }
        // }else{
        //     return response()->json(array(
        //         "No autorizado" => "Token inexistente"
        //     ), 401);
        // }

        $reportes = ReporteU::all();
        // var_dump($reportes);

        foreach ($reportes as $key => $value) {
            $tablas[$key]['id'] = $value->id;
            $tablas[$key]['descripcion'] = $value->descripcion;
            $tablas[$key]['creado'] = $value->created_at;

            $usuario = Usuarios::find($value->usuario);
            $tablas[$key]['usuario'] = $usuario->usuario;

            $usuario = Usuarios::find($value->usuario_reportado);
            $tablas[$key]['reportado'] = $usuario->usuario;

            $reporte = Reportes::find($value->reporte_tipo);
            $tablas[$key]['tipo'] = $reporte->descripcion;
            return response()->json($tablas, 401);
        }
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
