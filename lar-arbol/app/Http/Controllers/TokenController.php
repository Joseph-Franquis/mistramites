<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TokenController extends Controller
{
    //
    public function new(Request $request) {
        $token = $request->session()->token();
        $token = csrf_token();
    }
}
