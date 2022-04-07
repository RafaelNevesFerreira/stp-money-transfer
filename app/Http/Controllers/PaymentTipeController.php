<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentTipeController extends Controller
{
    public function verificar_condição_de_pagamento(Request $request){
        if ($request->has("abonements")) {
            dd($request->all());
        }
    }
}
