<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\StripeRepositoryInterface;
use App\Repositories\Contracts\TransfersRepositoryInterface;

class AdminController extends Controller
{
    public function __construct(public TransfersRepositoryInterface $transfers, public UserRepositoryInterface $users)
    {
        $this->middleware('admin');
    }


    public function dashboard()
    {
        $transfers_esta_semana = $this->transfers->transfers_esta_semana();
        $aumento_em_relacao_a_semana_passada = (float)$this->transfers->aumento_em_relacao_a_semana_passada();
        $novos_usuarios_esse_mes = (int)$this->users->novos_usuarios_esse_mes();
        $aumento_de_usuarios_em_relacao_aom_mes_passado = (float)$this->users->aumento_de_usuarios_em_relacao_aom_mes_passado();
        $numero_de_prestações_da_semana = $this->transfers->numero_de_prestações_da_semana();

        $saldo_semanal = $this->transfers->saldo_semanal();

        $lucros_desse_ano = $this->transfers->dados_grafico_receita();

        $lucros_ano_passado = $this->transfers->dados_grafico_receita_ano_passado();

        $saldo_semana_passada = $this->transfers->saldo_semana_passada();

        $pago_emprestacoes = $this->transfers->pagos_em_prestacoes_ou_cash(1, date("m"), date("Y"));

        $pago_em_cash = $this->transfers->pagos_em_prestacoes_ou_cash(0, date("m"), date("Y"));

        $usuarios_desse_mes = $this->users->usuarios_mes_ano(date("m"), date("Y"), 6);

        $transacoes_recentes = $this->transfers->transferencias_recentes(date("m"), date("Y"), 5);


        return view("admin.dashboard", compact(
            "transfers_esta_semana",
            "aumento_em_relacao_a_semana_passada",
            "novos_usuarios_esse_mes",
            "aumento_de_usuarios_em_relacao_aom_mes_passado",
            "numero_de_prestações_da_semana",
            "saldo_semanal",
            "saldo_semana_passada",
            "lucros_desse_ano",
            "lucros_ano_passado",
            "pago_emprestacoes",
            "pago_em_cash",
            "usuarios_desse_mes",
            "transacoes_recentes"
        ));
    }

    public function dashboard_stripe()
    {
        $numero_clientes = $this->users->all()->count();
        $numero_transactions = $this->transfers->all()->count();

        $prestacao = "";
        $sem_prestacao = "";
        for ($i = 1; $i < 13; $i++) {
            $prestacoes = $this->transfers->pagos_em_prestacoes_ou_cash(1, $i, date("Y"));
            $prestacao .= number_format($prestacoes, 2, ".", ".") . ",";

            $sem_prestacoes = $this->transfers->pagos_em_prestacoes_ou_cash(0, $i, date("Y"));
            $sem_prestacao .= number_format($sem_prestacoes, 2, ".", ".") . ",";
        }

        $prestacoes_grafico = "[" . $prestacao . "]";

        $sem_prestacoes_grafico = "[" . $sem_prestacao . "]";

        $prestacoes = $this->transfers->pagos_em_prestacoes_ou_cash(1, date("m"), date("Y"));
        $sem_prestacoes =  $this->transfers->pagos_em_prestacoes_ou_cash(0, date("m"), date("Y"));



        $saldos = [];
        for ($i = 1; $i < 8; $i++) {
            $valor = $this->transfers->saldo_semanal_em_dias($i);
            array_push($saldos, $valor);
        }


        $saldo = "";

        for ($i = 0; $i < count($saldos); $i++) {
            $saldo .= $saldos[6 - $i] . ',';
        }
        $saldo = "[" . $saldo . "]";

        $saldo_semanal = $this->transfers->saldo_semanal();

        $saldo_semana_passada = $this->transfers->saldo_semana_passada(true);

        $saldo_semana_passada_grafico = "";
        for ($i = 1; $i < 8; $i++) {
            $saldo_semana_passada_grafico .= $this->transfers->saldo_semana_passada_em_dias($i) . ",";
        }

        $paises = [
            [
                "name" => "Inglatera",
                "value" => $this->transfers->money_by_country("United Kingdom")
            ],
            [
                "name" => "França",
                "value" => $this->transfers->money_by_country("France")
            ],
            [
                "name" => "Portugal",
                "value" => $this->transfers->money_by_country("Portugal"),
            ],

            [
                "name" => "Holanda",
                "value" => $this->transfers->money_by_country("Netherlands")
            ],
        ];

        $top_5 = $this->transfers->top_5_transacoes(date("m"), date("Y"), 5, 200, 100000000);
        $saldo_semana_passada_grafico = "[" . $saldo_semana_passada_grafico . "]";

        return view("admin.dashboard-stripe", compact("top_5","paises", "saldo_semana_passada_grafico", "saldo_semanal", "saldo_semana_passada", "prestacoes", "sem_prestacoes", "saldo", "prestacoes_grafico", "sem_prestacoes_grafico"));
    }
}
