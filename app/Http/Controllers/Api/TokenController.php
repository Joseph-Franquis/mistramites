<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TokenController extends Controller
{
    /**
     * Controller to create a token from an active session
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function generateToken(Request $request)
    {
        //
        $session = $this->showSesion($request->id_session);
        $token = bin2hex(openssl_random_pseudo_bytes(24));
        $json = json_decode($session->payload);
        $json->token = $token;
        $json = json_encode($json);
        $this->updateSesion($request->id_session ,['payload' => $json]);
        return response()->json($token, 200);
    }



}
