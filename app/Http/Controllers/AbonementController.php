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
            //verifica se o usuario ja tem alguma subscription
            if ($this->plans->ifExist() > 0) {
                return redirect()->back()->withErrors("Desculpe Mas ja tem uma subscrição a pagar, assim que terminar de pagar podera fazer outra");
            }

            //inicia a variavel de stripe com a nossa chave secreta
            $stripe = new \Stripe\StripeClient(
                'sk_test_51JZwMrFzWXjclIq0uBjHEYo8XhVtSEQhe8eJ4Dt6Zwr7igTQ2p3MwIeUQ2RJgMtmAxBRCV6KAo5nJHYlGyoikr4s00T9dLQnId'
            );

            $link = $stripe->paymentLinks->create([
                'line_items' => [
                  [
                    'price' => 'price_1KlcEUFzWXjclIq0kPWaHzXs',
                    'quantity' => 1,
                  ],
                ],
              ]);

            // dd($link->url);


            //atribui a varivael nome o valor do nome de quem envia o dinhiro
            // $name = session("name");

            //prepara a query e faz uma pesquisa na apin do stripe para ver se existe algum cliente com esse nome
            // $client = $stripe->customers->search([
            //     'query' => "name:'" . $name . "' ",
            // ]);

            //verifica se o cliente existe, caso não cria um novo cliente com os dados do emisor do dinheiro
            // if ($client->count() == 0) {

                // $stripe->customers->create([
                //     'email' => session("email"),
                //     'name' => session("name"),
                //     'phone' => session("phone_number"),
                // ]);
                //espera 15 segundos, o tempo nesecario para que o cliente seja cadastrdado no banco de dados do stripe
                // sleep(20);
            // }

            //faz a pesquisa de novo, dessa vez para poder pegar o id do cliente
            // $client = $stripe->customers->search([
            //     'query' => "name:'" . $name . "' ",
            // ]);

            //pega todos os cartões de credito usados pelo cliente
            // $card = $stripe->customers->allSources(
            //     $client->data[0]->id,
            //     ['object' => 'card']
            // );

            //inicializa a variavel exit como sendo false, ou seja o cartão ainda não foi usado pelo cliente
            // $exist = false;

            //verifica se o cliente temcartões registrados, caso tenha, verifica se nos cartoes registrados os ultimos 4
            //numeros batem com os ultimos do cartão que sta sendo usado agora, caso sim a variavel exist recebera true
            //caso ainda não tenha o catão registrado, exist = false, e caso não tenha cartão alhum registrado, exist = false
            // if (count($card->data) > 0) {
            //     for ($i = 0; $i < count($card->data); $i++) {
            //         if ($card->data[$i]["last4"] == substr($request->card_no, strlen($request->card_no) - 4)) {
            //             $exist = true;
            //             $card_id = $card->data[$i]["id"];
            //         }
            //     }
            // } else {
            //     $exist = false;
            // }

            //espera 5 segundos e depois adiciona o cartão criado como sendo default, para que dessa maneira o pagamento seja feito
            //com esse novo cartão registrado
            // if ($exist == true) {
            //     sleep(5);
            //     $stripe->customers->update(
            //         $client->data[0]->id,
            //         ['default_source' => $card_id]
            //     );
            // }


            //verifica se a variavel exist = false, se sim então cria um novo cartão de credito ligado ao cliente
            // if (isset($exist) && $exist != true) {
            //     $new_card = $stripe->customers->createSource(
            //         $client->data[0]->id,
            //         [
            //             'source' => [
            //                 "object" => "card",
            //                 "number" => $request->card_no,
            //                 "exp_month" => $request->exp_month,
            //                 "exp_year" => $request->exp_year,
            //                 "cvc" => $request->cvc,
            //                 "default_for_currency" => true,
            //             ],
            //         ],
            //     );

                // sleep(5);
                //espera 5 segundos e depois adiciona o cartão criado como sendo default, para que dessa maneira o pagamento seja feito
                //com esse novo cartão registrado
                // $stripe->customers->update(
                //     $client->data[0]->id,
                //     ['default_source' => $new_card->id]
                // );
            // }

            $total = (session("total") / 100 * 20 + session("total")) /2;

            $plan = $stripe->plans->create([
                'amount' => $total * 100,
                'currency' => 'eur',
                'interval' => 'month',
                'product' => 'prod_LSXJFWphfFl1Cc',
            ]);

            //insere no nosso db plans o id do cliente, para que dessa maneira na proxima subscription possamos ver que
            //o cliente ja tem uma subscription que ainda não foi totalmente pagada
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
