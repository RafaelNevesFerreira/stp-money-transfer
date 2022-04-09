<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\Request;
use App\Http\Requests\PaymentRequest;
use App\Http\Controllers\PaymentController;
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


        $date = DateTime::createFromFormat('d-m-Y H:i:s', "22-09-2022 00:00:00");
        $date = $date->getTimestamp();



        sleep(20);
        $name = session("name");

        $client = $stripe->customers->search([
            'query' => "name:'" . $name . "'",
        ]);

        sleep(10);
        $stripe->customers->createSource(
            $client->data[0]->id,
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
            'customer' => $client->data[0]->id,
            'items' => [
                ['price' => 'plan_LTTW2Nne4lQtDt'],
            ],
            "cancel_at" => $date
        ]);

        sleep(10);



        $price = $stripe->paymentIntents->search([
            'query' => "customer:'" . $client->data[0]->id . "'",
        ]);

        sleep(10);
        $stripe->paymentIntents->confirm(
            $price->data[0]->id,
            ['payment_method' => 'pm_card_visa']
        );


        dd("done");

        return $this->payment->store($request);
    }
}
