<?php

namespace App\Http\Controllers;

use App\Http\Requests\DetailsRequest;
use App\Http\Requests\IdentificationRequest;
use App\Models\TransactionPlansDef;
use Illuminate\Http\Request;

class SendMoneyController extends Controller
{
    public function details(DetailsRequest $request)
    {
        $valor = (float) str_replace(".", "", $request->valor_enviado);

        if ($valor >= 100 && $valor <= 400) {
            $minha_tax = 27;
        } else if ($valor > 400 && $valor <= 800) {
            $minha_tax = 50;
        } else if ($valor > 800 && $valor <= 1000) {
            $minha_tax = 150;
        } else if ($valor == 25) {
            $minha_tax = 5;
        } else if ($valor < 25) {
            $minha_tax = 3;
        } else {
            $minha_tax = 10;
        }
        $tax = $valor * 0.029 + 0.3 + $minha_tax;


        $total = $valor + $tax;

        if ($request->moeda == "eur") {
            $moeda = "€";
        } elseif ($request->moeda == "usd") {
            $moeda = "$";
        } else {
            $moeda = "£";
        }
        session()->put(["total" => $total, "valor_a_ser_enviado" => $valor, "tax" => $tax, "receptor" => $request->nomedoreceptor, "moeda" => $moeda]);

        return redirect()->route("identification");
    }

    public function identification(IdentificationRequest $request)
    {
        $data[] = $request->all();

        session()->put([
            "name" => $request->name,
            "phone_number" => $request->phone_number,
            "email" => $request->email,
            "address" => $request->address,
            "country" => $request->country,
        ]);

        return redirect()->route("payment");
    }
}
