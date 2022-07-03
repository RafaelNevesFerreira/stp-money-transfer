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
