<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\PaymentController;
use App\Http\Requests\PaymentRequest;
use App\Repositories\Contracts\PlansRepositoryInterface;

class AbonementController extends Controller
{

    public function __construct(public PlansRepositoryInterface $plans, public PaymentController $payment)
    {
    }
    public function pagar_em_3_vezes(Request $request)
    {
        dd($request->all());
    }

    public function pagar_em_2_vezes(PaymentRequest $request)
    {

        $stripe = new \Stripe\StripeClient(
            'sk_test_51JZwMrFzWXjclIq0uBjHEYo8XhVtSEQhe8eJ4Dt6Zwr7igTQ2p3MwIeUQ2RJgMtmAxBRCV6KAo5nJHYlGyoikr4s00T9dLQnId'
        );

        $have_a_plan = $this->plans->ifExist();


        $costumer = $stripe->customers->create([
            'email' => session("email"),
            'name' => session("name"),
            'phone' => session("phone_number"),
        ]);

         $stripe->customers->createSource(
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
                ['price' => 'plan_LTTW2Nne4lQtDt'],
            ],
        ]);



        sleep(15);
        $name = session("name");
        $client = $stripe->customers->search([
            'query' => "name:'" . $name . "'",
        ]);

        $price = $stripe->paymentIntents->search([
            'query' => "customer:'" . $client->data[0]->id . "'",
        ]);

        $payment = $stripe->paymentIntents->confirm(
            $price->data[0]->id,
            ['payment_method' => 'pm_card_visa']
        );


        dd("done");

        return $this->payment->store($request);
    }
}
