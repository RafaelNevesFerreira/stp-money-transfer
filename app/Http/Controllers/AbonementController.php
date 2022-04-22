<?php

namespace App\Http\Controllers;

use App\Jobs\PlansJob;
use Illuminate\Http\Request;
use App\Mail\PaimentFailedMail;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PaymentRequest;
use App\Http\Controllers\PaymentController;
use App\Repositories\Contracts\PlansRepositoryInterface;

class AbonementController extends Controller
{
    const STRIPE_KEY = "sk_test_51JZwMrFzWXjclIq0uBjHEYo8XhVtSEQhe8eJ4Dt6Zwr7igTQ2p3MwIeUQ2RJgMtmAxBRCV6KAo5nJHYlGyoikr4s00T9dLQnId";


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
            //inicia a variavel de stripe com a nossa chave secreta
            $stripe = new \Stripe\StripeClient(
                self::STRIPE_KEY
            );

            $link = $stripe->paymentLinks->create([
                'line_items' => [
                  [
                    'price' => 'price_1KlcEUFzWXjclIq0kPWaHzXs',
                    'quantity' => 1,
                  ],
                ],
              ]);

            $total = (session("total") / 100 * 20 + session("total")) /2;

            $plan = $stripe->plans->create([
                'amount' => $total * 100,
                'currency' => 'eur',
                'interval' => 'month',
                'product' => 'prod_LSXJFWphfFl1Cc',
            ]);

            //insere no nosso db plans o id do cliente, para que dessa maneira na proxima subscription possamos ver que
            $link = $stripe->paymentLinks->create([
                'line_items' => [
                    [
                        'price' => $plan->id,
                        'quantity' => 1,
                    ],
                ],
            ]);

            return redirect()->away($link->url);

            dd("done");
        } catch (\Stripe\Exception\CardException $error) {
            // caso aconteça algum erro generico:

            // $stripe->customers->delete(
            //     $client->data[0]->id,
            // );

            //redireciona para o view pagamento com  a menssagem do erro
            return redirect()->back()->withErrors($error->getError()->message);
        }

        dd("done");
    }
}
