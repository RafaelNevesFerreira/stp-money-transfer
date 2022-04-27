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
        return view("tecnicos.dashboard",compact("received_this_month","reimbursed_this_month","abonement_this_month",));
    }
}
