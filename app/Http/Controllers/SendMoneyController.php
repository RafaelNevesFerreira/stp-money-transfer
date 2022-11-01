<?php

namespace App\Http\Controllers;

use App\Http\Requests\DetailsRequest;
use App\Http\Requests\IdentificationRequest;

class SendMoneyController extends Controller
{
    public function details(DetailsRequest $request)
    {
        $valor = (float) str_replace(".", "", $request->valor_enviado);

        $tax = $this->calculate_tax($valor);

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

    public function calculate_tax($valor)
    {
        if ($valor >= 20 && $valor <= 50) {
            $minha_tax = 2;
        } else if ($valor > 50 && $valor <= 150) {
            $minha_tax = 4.5;
        } else if ($valor > 150 && $valor <= 300) {
            $minha_tax = 9;
        } else if ($valor > 300 && $valor <= 500) {
            $minha_tax = 15;
        } else if ($valor > 500 && $valor <= 1000) {
            $minha_tax = 30;
        } else if ($valor > 1000 && $valor <= 2500) {
            $minha_tax = 75;
        } else if ($valor > 2500 && $valor <= 5000) {
            $minha_tax = 150;
        } else if ($valor < 20) {
            $minha_tax = 1;
        }

        return $valor * 0.030 + 0.3 + $minha_tax;
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
