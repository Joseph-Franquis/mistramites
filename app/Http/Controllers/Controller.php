<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function startSesion($id = null)
    {
        DB::table('sessions')->insert([
            'last_activity' => date("H:i:s"),
            'id_session' => $id,
            'payload' => "{}",
        ]);
    }

    public function showSesion($id = null)
    {
        $session = DB::table('sessions')->where('id_session', $id)->first();
        return $session;
    }

    public function updateSesion($id ,$params)
    {
        DB::table('sessions')->where('id_session', $id)->update(
            $params
        );
    }
}
