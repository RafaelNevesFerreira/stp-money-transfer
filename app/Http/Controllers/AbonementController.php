<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PaymentRequest;
use App\Repositories\Contracts\PlansRepositoryInterface;
use App\Repositories\Contracts\TransfersRepositoryInterface;

class AbonementController extends Controller
{
    const STRIPE_KEY = "sk_test_51JZwMrFzWXjclIq0uBjHEYo8XhVtSEQhe8eJ4Dt6Zwr7igTQ2p3MwIeUQ2RJgMtmAxBRCV6KAo5nJHYlGyoikr4s00T9dLQnId";
    const VALOR_MAXIMO = 700;
    const VALOR_MINIMO = 100;
    const TAX_POR_ENVIO_EM_PERCENTAGEM = 20;


    public function __construct(public PlansRepositoryInterface $plans, public TransfersRepositoryInterface $transfer)
    {
    }
    public function pagar_em_2_vezes(PaymentRequest $request)
    {

        try {
            //inicia a variavel de stripe com a nossa chave secreta
            $stripe = new \Stripe\StripeClient(
                self::STRIPE_KEY
            );

            //pega os planos que o cliente ja fez, se fez.
            $users_plans_exist = $this->plans->ifExist();

            //verifica se o cliente ja fez algum pagamento em prestações
            //se ja cai no condição
            if ($users_plans_exist->count() > 0) :

                //para cada plano que o usuario fez, ele ira passar poe um ciclo,
                //caso o usuario tenha feito mais que um, ele ira pegar todos e verificar
                //a diferença entre as datas
                foreach ($users_plans_exist as $user_plans) {

                    //pega a diferenca entre o dia do ultimo envio e o dia de hoje em relação ao numero de meses
                    $data = $user_plans->created_at->format('Y-m-d');

                    $hoje = new DateTime(date("Y-m-d"));
                    $data_do_envio = new DateTime($data);

                    $interval = $data_do_envio->diff($hoje);

                    $difference = $interval->format('%r%m');


                    //verifica se o ultimo pagamento em prestações foi num periudo menor ou igual a 2 meses
                    //o cliente so pode fazer um novo envio se ja se passaram 3 messes depois do ultimo envio
                    if ($difference <= 2) {
                        return redirect()
                            ->back()
                            ->withErrors("So serà possivel fazer um novo envio a pagar em prestações depois de  2 messe pa
                        sados do dia do ultimo envio em prestações, apenas podera fazer um novo envio em prestações
                        3 mêses passados do $data");
                    }
                }
            endif;


            //prepara o total, somando o total que ja vem com as nossas taxas normais e adiciona uma taxa
            //de 20% em cima do valor
            $total = number_format((session("total") / 100 * self::TAX_POR_ENVIO_EM_PERCENTAGEM + session("total")) / 2, 2, ".", ",");


            //caso o valor que o usuario queira enviar seja maior do que o valor setado na constante VALOR_MAXIMO
            //e que ele seja maior do que o valor da constante VALOR_MINIMO
            if (session("valor_a_ser_enviado") >= self::VALOR_MAXIMO) {
                return redirect()->back()->withErrors("desculpe por enquanto so é posivel enviar um valor a baixo de "
                    . self::VALOR_MAXIMO . session("moeda") . " caso queira pagar em prestações, clique no link a baixo e digite um valor abaixo de "
                    . self::VALOR_MAXIMO . session("moeda") . " Obrigado" . "<br><a href='" . route("send") . "' class='btn-link'>Inserir Novo Valor</a>");
            } else if (session("valor_a_ser_enviado") < self::VALOR_MINIMO) {
                return redirect()->back()->withErrors("desculpe por enquanto apenas é posivel enviar um valor acima  de "
                    . self::VALOR_MINIMO . session("moeda") . " caso queira pagar em prestações, clique no link a baixo e digite um valor acima  de "
                    . self::VALOR_MINIMO . session("moeda") . " Obrigado" . "<br><a href='" . route("send") . "' class='btn-link'>Inserir Novo Valor</a>");
            }

            //adiciona o valor certo da moeda para a variavel cuurency
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


            //cria o plano stripe
            $plan = $stripe->plans->create([
                'amount' => $total * 100,
                'currency' => $currency,
                'interval' => 'month',
                'product' => 'prod_LSXJFWphfFl1Cc',
                "metadata" => ["user_id" => Auth::user()->id, "name" => Auth::user()->name, "email" => Auth::user()->email]
            ]);

            //Cria o link do stripe para fazer o pagamento atraves da pagina deles
            $link = $stripe->paymentLinks->create([
                'line_items' => [
                    [
                        'price' => $plan->id,
                        'quantity' => 1,
                    ],
                ],

                //quando o pagamento for sucedido, ele redireciona o usuario para a nossa rota de confirmação
                "after_completion" => [
                    "redirect" => [
                        "url" => route("plan_success")
                    ],
                    "type" => "redirect"
                ],
            ]);

            return redirect()->away($link->url);
        } catch (\Stripe\Exception\CardException $error) {
            // caso aconteça algum erro generico:
            //redireciona para o view pagamento com  a menssagem do erro
            return redirect()->back()->withErrors($error->getError()->message);
        }
    }

    public function success()
    {
        //verifica se tem dados na sesseion name
        //faz isso para caso o usuario dar um reload na pagina
        //ele redirecionar directamente para a pagina de inicio
        if (!session("name")) {
            return redirect()->route("home");
        }

        //atribui os valores da session para variaveis
        //dessa forma elas poderão ser compactadas e passadas para a
        //view
        $valor = session("valor_a_ser_enviado");
        $moeda = session("moeda");
        $receptor = session("receptor");
        $valor_debitado = (session("total") / 100 * 20 + session("total")) / 2;

        //inicia a session plan, dessa forma quando chamar o strore do transfer o campo plan na tabela transfer
        //recebera true, dessa forma poderemos saber que pagamento foi feito em prestações
        session()->put(["plan" => true]);

        //guarda os dados na table plans
        $this->plans->store();

        //guarda os dados na table transfer
        $this->transfer->store();

        //apaga todos os valores na seção relacionado com o envio
        session()->forget(["moeda", "plan", "name", "receptor", "address", "country", "phone_number", "email", "tax", "valor_a_ser_enviado", "total"]);

        //retorna a view de confirmação de envio de dinheiro
        return view("site.plan_confirmation", compact("valor", "moeda", "valor_debitado", "receptor"));
    }
}
