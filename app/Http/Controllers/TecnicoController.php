<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\TransfersRepositoryInterface;
use Illuminate\Http\Request;

class TecnicoController extends Controller
{

    public function __construct(public TransfersRepositoryInterface $transfer)
    {
    }
    public function dashboard()
    {

        $received_this_month = $this->transfer->received_this_month();
        $reimbursed_this_month = $this->transfer->reimbursed_this_month();
        $abonement_this_month = $this->transfer->abonement_this_month();
        $to_received_this_month = $this->transfer->to_received_this_month();

        $transfers_today = $this->transfer->transfers_today();
        return view("tecnicos.dashboard", compact(
            "received_this_month",
            "reimbursed_this_month",
            "abonement_this_month",
            "to_received_this_month",
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
        $this->transfer->change_status($request->id,false);
    }
}
