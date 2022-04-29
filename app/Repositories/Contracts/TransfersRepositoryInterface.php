<?php

namespace App\Repositories\Contracts;

interface TransfersRepositoryInterface{
    public function all();
    public function store();
    public function get_by_user_email();
    public function details($id);
    public function received_this_month();
    public function reimbursed_this_month();
    public function abonement_this_month();
    public function to_received_this_month();
    public function transfers_today();
    public function change_status($id);
    public function transfers_esta_semana();
    public function aumento_em_relacao_a_semana_passada();
    public function numero_de_prestações_da_semana();
    public function saldo_semanal();
    public function saldo_semana_passada($start_week =null, $end_week =null);
    public function dados_grafico_receita();
    public function dados_grafico_receita_ano_passado();
    public function pagos_em_prestacoes_ou_cash($plan);
    public function transferencias_recentes($month,$year);
}
