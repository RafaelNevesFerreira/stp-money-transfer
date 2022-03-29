<?php

namespace App\Http\Controllers;

use App\Http\Requests\DetailsRequest;
use Illuminate\Http\Request;

class SendMoneyController extends Controller
{
    public function details(DetailsRequest $request)
    {
        dd($request->all());
    }
}
