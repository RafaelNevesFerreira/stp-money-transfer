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

            //atribui a varivael nome o valor do nome de quem envia o dinhiro
            $name = session("name");

            //prepara a query e faz uma pesquisa na apin do stripe para ver se existe algum cliente com esse nome
            $client = $stripe->customers->search([
                'query' => "name:'" . $name . "' ",
            ]);

            //verifica se o cliente existe, caso não cria um novo cliente com os dados do emisor do dinheiro
            if ($client->count() == 0) {

                $stripe->customers->create([
                    'email' => session("email"),
                    'name' => session("name"),
                    'phone' => session("phone_number"),
                ]);
                //espera 20 segundos, o tempo nesecario para que o cliente seja cadastrdado no banco de dados do stripe
                sleep(20);
            }

            //faz a pesquisa de novo, dessa vez para poder pegar o id do cliente
            $client = $stripe->customers->search([
                'query' => "name:'" . $name . "' ",
            ]);


            //pega todos os cartões de credito usados pelo cliente
            $card = $stripe->customers->allSources(
                $client->data[0]->id,
                ['object' => 'card']
            );

            //inicializa a variavel exit como sendo false, ou seja o cartão ainda não foi usado pelo cliente
            $exist = false;

            //verifica se o cliente temcartões registrados, caso tenha, verifica se nos cartoes registrados os ultimos 4
            //numeros batem com os ultimos do cartão que sta sendo usado agora, caso sim a variavel exist recebera true
            //caso ainda não tenha o catão registrado, exist = false, e caso não tenha cartão alhum registrado, exist = false
            if (count($card->data) > 0) {

                for ($i = 0; $i < count($card->data); $i++) {
                    if ($card->data[$i]["last4"] == substr($request->card_no, strlen($request->card_no) - 4)) {
                        $exist = true;
                    }
                }
            } else {
                $exist = false;
            }

            //verifica se a variavel exist = false, se sim então cria um novo cartão de credito ligado ao cliente
            // if (isset($exist) && $exist != true) {
                // $stripe->customers->createSource(
                //     $client->data[0]->id,
                //     [
                //         'source' => [
                //             "object" => "card",
                //             "number" => $request->card_no,
                //             "exp_month" => $request->exp_month,
                //             "exp_year" => $request->exp_year,
                //             "cvc" => $request->cvc,
                //         ],
                //     ],
                // );
            // }

            //insere no nosso db plans o id do cliente, para que dessa maneira na proxima subscription possamos ver que
            //o cliente ja tem uma subscription que ainda não foi totalmente pagada
            $this->plans->store();


            //despacha o job responsavel por concluir o pagamento
            PlansJob::dispatch($request->all(), $name, session("total"), Auth::user()->email)->delay(now()->addMinutes(1));

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
