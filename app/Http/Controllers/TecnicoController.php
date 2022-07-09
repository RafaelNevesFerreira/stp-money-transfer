<?php

namespace App\Http\Controllers;

use App\Jobs\Review;
use Illuminate\Http\Request;
use App\Repositories\Contracts\TransfersRepositoryInterface;

class TecnicoController extends Controller
{

    public function __construct(public TransfersRepositoryInterface $transfer)
    {
    }
    public function dashboard()
    {

        $received = $this->transfer->received();
        $reimbursed_this_month = $this->transfer->reimbursed_this_month();
        $to_receive = $this->transfer->to_receive();

        $transfers_today = $this->transfer->transfers_today();
        return view("tecnicos.dashboard", compact(
            "received",
            "reimbursed_this_month",
            "to_receive",
            "transfers_today"
        ));
    }

    public function transactions()
    {
        $transfers = $this->transfer->all();
        return view("tecnicos.transfers", compact("transfers"));
    }

    public function new_transaction(Request $request)
    {
        try {
            $request->validate([
                "destinatary_name" => "required|max:300",
                "name" => "required|string|max:255",
                "address" => "required|string|max:200",
                "country" => "required|string|max:120",
                "email" => "required|email",
                "phone_number" => "required",
                "comprovativo" => "required|file",
                "valor_enviado" => "required",
                "moeda" => "required"
            ]);


            $transfer = $this->transfer->new_transfer($request->all());
            $this->transfer->storeImage($request, $transfer->id);


            return redirect()->back()->with(["message" => "Transação efectuada com sucesso","status" => 200]);
        } catch (\Throwable $th) {
            return redirect()->back()->with(["message" => "Erro ao efectuar Transação","status" => 500]);
        }
    }

    public function transaction_details($id)
    {
        $transfer = $this->transfer->details($id);
        return view("tecnicos.details", compact("transfer"));
    }

    public function change_status(Request $request)
    {

        $request->validate([
            "last_name" => "required",
            "name" => "required",
            "nationality" => "required",
            "birthday_date" => "required",
            "id" => "required|exists:transfers,id",
            "email" => "required"
        ]);


        $this->transfer->change_status($request->id, $request->all());
        Review::dispatch($request->email)->delay(now());
    }
}
