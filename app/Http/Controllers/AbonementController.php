<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PaymentRequest;
use App\Http\Controllers\PaymentController;
use App\Jobs\PlansJob;
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
        try {

            $stripe = new \Stripe\StripeClient(
                'sk_test_51JZwMrFzWXjclIq0uBjHEYo8XhVtSEQhe8eJ4Dt6Zwr7igTQ2p3MwIeUQ2RJgMtmAxBRCV6KAo5nJHYlGyoikr4s00T9dLQnId'
            );

            $name = session("name");

            $client = $stripe->customers->search([
                'query' => "name:'" . $name . "' ",
            ]);



            // dd($card->data);

            if ($client->count() == 0) {

                $stripe->customers->create([
                    'email' => session("email"),
                    'name' => session("name"),
                    'phone' => session("phone_number"),
                ]);

                sleep(20);
            }


            $client = $stripe->customers->search([
                'query' => "name:'" . $name . "' ",
            ]);

            // dd($client);

            $card = $stripe->customers->allSources(
                $client->data[0]->id,
                ['object' => 'card']
            );

            // substr($request->card_no, strlen($request->card_no)-4);
            foreach ($card->data as $memes) {
                if ($memes->last4 == substr($request->card_no, strlen($request->card_no) - 4)) {
                    $exist = true;
                }
            }

            // dd($client);


            sleep(10);

            if ($exist != true) {
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
            }


            PlansJob::dispatch($request->all(), $name, session("total"))->delay(now()->addMinutes(1));
        } catch (\Throwable $th) {
            $stripe->customers->delete(
                $client->data[0]->id,
            );
            return redirect()->back()->withErrors("Desculpe, Não foi possivel realizar a operação, verifique se seus dados estão corretos ou se o seu saldo é suficiente");
        }


        dd("done");

        return $this->payment->store($request);
    }
}
