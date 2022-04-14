<?php

namespace App\Http\Controllers;

use App\Jobs\PlansJob;
use Illuminate\Http\Request;
use App\Mail\PaimentFailedMail;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PaymentRequest;
use App\Http\Controllers\PaymentController;
use App\Repositories\Contracts\PlansRepositoryInterface;
use App\Repositories\Contracts\TransfersRepositoryInterface;

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

            dd(
                $client->data[0]->id,
            );

            //insere no nosso db plans o id do cliente, para que dessa maneira na proxima subscription possamos ver que
            //o cliente ja tem uma subscription que ainda não foi totalmente pagada
            $this->plans->store();


            //despacha o job responsavel por concluir o pagamento
            PlansJob::dispatch($request->all(), $name, session("total"), Auth::user()->email)->delay(now()->addMinutes(1));

            $valor = session("valor_a_ser_enviado");
            $moeda = session("moeda");
            $receptor = session("receptor");
            session()->forget(["moeda", "name", "receptor", "address", "country", "phone_number", "email", "tax", "valor_a_ser_enviado", "total"]);

            return view("site.payment_confirm", compact("valor", "moeda", "receptor"));

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
