<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\UserRepositoryInterface;
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

        $pago_emprestacoes = $this->transfers->pagos_em_prestacoes_ou_cash(1);

        $pago_em_cash = $this->transfers->pagos_em_prestacoes_ou_cash(0);

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
        return view("admin.dashboard-stripe");
    }
}
