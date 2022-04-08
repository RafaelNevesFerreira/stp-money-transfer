<?php

namespace App\Http\Controllers;

use App\Http\Requests\PaymentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaymentTipeController extends Controller
{
    public function __construct(public AbonementController $abonement, public PaymentController $payment)
    {
    }


    public function verificar_condição_de_pagamento(PaymentRequest $request)
    {

        if ($request->has("pagar_em_prestacoes") && Auth::check()) {
            if ($request->has("numero_prestacoes")) {
                if ($request->numero_prestacoes == "3") {
                    $this->abonement->pagar_em_3_vezes($request);
                } else {
                    $this->abonement->pagar_em_2_vezes($request);
                }
            } else {
                return redirect()->back()->withErrors("Se Quiser pagar em prestações Deve Escolher Em Quantas vezes deseja pagar em prestções");
            }
        } else if ($request->has("pagar_em_prestacoes") && Auth::check() == false) {
            // $this->payment->store($request);
            // dd($request->all());
            return redirect()->back()->withErrors("para pagar em prestações deve se registrar, ou se ja tem uma conta deve fazer o login");
        }
    }
}
