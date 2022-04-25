<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfilleChangeData;
use App\Repositories\Contracts\TransfersRepositoryInterface;

class ProfileController extends Controller
{
    public function __construct(public TransfersRepositoryInterface $transfers)
    {
    }
    public function profille()
    {
        $transfers  = $this->transfers->get_by_user_email();

        return view("profile.profille", compact("transfers"));
    }

    public function settings()
    {
        return view("profile.settings");
    }

    public function transactions(){
        $transfers  = $this->transfers->get_by_user_email();

        return view("profile.transactions",compact("transfers"));
    }


    public function transfer_details(Request $request)
    {
        $request->validate([
            "id" => "required|numeric|min:0"
        ]);
        $details = $this->transfers->details($request->id);
        return $details;
    }

    public function profilleChangeDta(ProfilleChangeData $request)
    {
        dd($request->all());
    }
}
