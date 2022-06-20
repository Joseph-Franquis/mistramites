<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Etiquetas;

class EtiquetasController extends Controller
{
    /**
     * Controller to return all labels
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $publicaciones = Etiquetas::get();
        $tablas = [];
        $rows = [];
        foreach ($publicaciones as $key => $value) {
            $tablas[$key]['id'] = $value->id;
            $tablas[$key]['nombre'] = $value->nombre;
        }
        return response()->json($tablas, 200);
    }
}
