<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentTipeController extends Controller
{
    public function __construct(public AbonementController $abonement)
    {
    }


    public function verificar_condição_de_pagamento(Request $request)
    {
        if ($request->has("pagar_em_prestacoes") && Auth::check()) {
            if ($request->numero_prestacoes == "3") {
                $this->abonement->pagar_em_3_vezes($request);
            } else {
                $this->abonement->pagar_em_2_vezes($request);
            }
        }else{
            return redirect()->back()->with("error","para pagar em prestaç~es deve se registrar");
        }
    }
}
