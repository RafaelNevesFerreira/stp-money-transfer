<?php

namespace App\Http\Controllers;

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

        return view("profile.profille",compact("transfers"));
    }

    public function settings()
    {
        return view("profile.settings");
    }

    public function profilleChangeDta(ProfilleChangeData $request)
    {
        dd($request->all());
    }
}
