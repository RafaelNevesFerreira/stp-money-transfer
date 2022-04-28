<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\TransfersRepositoryInterface;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct(public TransfersRepositoryInterface $transfers)
    {
        $this->middleware('admin');
    }


    public function dashboard()
    {
        $transfers_esta_semana = $this->transfers->transfers_esta_semana();

        // dd($transfers_esta_semana);
        return view("admin.dashboard",compact("transfers_esta_semana"));
    }
}
