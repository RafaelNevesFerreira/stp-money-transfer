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

    public $valor_maximo;
    public $VALOR_MINIMO;
    public $TAX_POR_ENVIO_EM_PERCENTAGEM;

    public function __construct(

        public PlansRepositoryInterface $plans,
        public TransfersRepositoryInterface $transfers,
    ) {
        $this->valor_maximo = null;
        $this->VALOR_MINIMO = null;
        $this->TAX_POR_ENVIO_EM_PERCENTAGEM = null;
    }
    public function pagar_em_2_vezes()
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
                            ->withErrors("só serà possivel fazer um novo envio e pagar em prestações depois de  2 meses pa
                        sados da data do último envio pago em prestações, apenas poderá fazer um novo envio pago em prestações
                        3 meses passados do dia " . $data);
                    }
                }
            endif;
            //verifica se o numero de transacoes que p usuario ja fez equivale ao minimo necessario para poder
            //pagar em prestacoes
            $min_transactions = $this->system_def->get("min_transactions")->min_transactions;
            if (!$this->transfers->user_count_transactions(Auth::user()->email) > $min_transactions) {
                return redirect()->back()->withErrors("Infelizmente não sera possivel efetuar a ação desejada,
                Pois o seu perfil não satisfaz as exigências requeridas para poder pagar em prestações. Apenas
                podera pagar em prestações depois da sua $min_transactions  Transação");
            }


            //prepara o total, somando o total que ja vem com as nossas taxas normais e adiciona uma taxa
            //de 20% em cima do valor
            $total = number_format((session("total") / 100 * $this->TAX_POR_ENVIO_EM_PERCENTAGEM + session("total")) / 2, 2, ".", ",");


            //caso o valor que o usuario queira enviar seja maior do que o valor setado na constante valor_maximo
            //e que ele seja maior do que o valor da constante VALOR_MINIMO
            if (session("valor_a_ser_enviado") >= $this->valor_maximo) {
                return redirect()->back()->withErrors("desculpe por enquanto só é possível enviar um valor abaixo de "
                    . $this->valor_maximo . session("moeda") . ", caso queira pagar em prestações, clique no link abaixo e digite um valor abaixo de "
                    . $this->valor_maximo . session("moeda") . " Obrigado" . "<br><a href='" . route("send") . "' class='btn-link'>Inserir Novo Valor</a>");
            } else if (session("valor_a_ser_enviado") < $this->VALOR_MINIMO) {
                return redirect()->back()->withErrors("desculpe por enquanto apenas é possível enviar um valor acima  de "
                    . $this->VALOR_MINIMO . session("moeda") . ", caso queira pagar em prestações, clique no link abaixo e digite um valor acima  de "
                    . $this->VALOR_MINIMO . session("moeda") . " Obrigado" . "<br><a href='" . route("send") . "' class='btn-link'>Inserir Novo Valor</a>");
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
        $this->transfers->store();

        //apaga todos os valores na seção relacionado com o envio
        session()->forget(["moeda", "tax", "plan", "name", "receptor", "address", "country", "phone_number", "email", "tax", "valor_a_ser_enviado", "total"]);

        //retorna a view de confirmação de envio de dinheiro
        return view("site.plan_confirmation", compact("valor", "moeda", "valor_debitado", "receptor"));
    }
}
