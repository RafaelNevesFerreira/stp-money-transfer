<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfilleChangeData;

class ProfileController extends Controller
{
    public function __construct()
    {

    }
    public function profille()
    {
        return view("profile.settings");
    }

    public function profilleChangeDta(ProfilleChangeData $request)
    {
        dd($request->all());
    }
}
