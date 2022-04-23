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
    public function pagar_em_2_vezes(PaymentRequest $request)
    {
        try {
            //inicia a variavel de stripe com a nossa chave secreta
            $stripe = new \Stripe\StripeClient(
                self::STRIPE_KEY
            );

            //prepara o total, somando o total que ja vem com as nossas taxas normais e adiciona uma taxa
            //de 20% em cima do valor
            $total = (session("total") / 100 * 20 + session("total")) /2;

            //adiciona o valor certo da moeda para a variavel
            switch (session("moeda")) {
                case "€":
                    $currency = "eur";
                    break;
                case '$':
                    $currency = "usd";
                    break;
                case '£':
                    $currency = "gbp";

                    break;
            }

            $name = session("name");
            //cria o plano stripe
            $plan = $stripe->plans->create([
                'amount' => $total * 100,
                'currency' => $currency,
                'interval' => 'month',
                'product' => ["name"=>"Pagar em 2x $name","tax_code" => "txcd_20030000"],
            ]);

            //Cria o link do stripe para fazer o pagamento atraves da pagina deles
            $link = $stripe->paymentLinks->create([
                'line_items' => [
                    [
                        'price' => $plan->id,
                        'quantity' => 1,
                    ],
                ],
            ]);

            //apaga todos os valores na seção relacionado com o envio
            session()->forget(["moeda", "name", "receptor", "address", "country", "phone_number", "email", "tax", "valor_a_ser_enviado", "total"]);

            return redirect()->away($link->url);

        } catch (\Stripe\Exception\CardException $error) {
            // caso aconteça algum erro generico:
            //redireciona para o view pagamento com  a menssagem do erro
            return redirect()->back()->withErrors($error->getError()->message);
        }

    }
}
