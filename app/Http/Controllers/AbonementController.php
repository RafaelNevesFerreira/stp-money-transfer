<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\PlansRepositoryInterface;
use Illuminate\Http\Request;

class AbonementController extends Controller
{

    public function __construct(public PlansRepositoryInterface $plans){

    }
    public function pagar_em_3_vezes(Request $request)
    {
        dd($request->all());
    }

    public function pagar_em_2_vezes(Request $request)
    {
        $stripe = new \Stripe\StripeClient(
            'sk_test_51JZwMrFzWXjclIq0uBjHEYo8XhVtSEQhe8eJ4Dt6Zwr7igTQ2p3MwIeUQ2RJgMtmAxBRCV6KAo5nJHYlGyoikr4s00T9dLQnId'
        );

        $have_a_plan = $this->plans->ifExist();

        dd($have_a_plan);

        $costumer = $stripe->customers->create([
            'email' => session("email"),
            'name' => session("name"),
            'phone' => session("phone_number"),
        ]);

        $card = $stripe->customers->createSource(
            $costumer->id,
            [
                'source' => [
                    "object" => "card",
                    "number" => $request->card_no,
                    "exp_month" => $request->exp_month,
                    "exp_year" => $request->exp_year,
                    "cvc" => $request->cvc,
                ],
            ],
        );

        $stripe->subscriptions->create([
            'customer' => $costumer->id,
            'items' => [
                ['price' => 'price_1KlcEUFzWXjclIq0kPWaHzXs'],
            ],
        ]);
        dd($request->all());
    }
}
