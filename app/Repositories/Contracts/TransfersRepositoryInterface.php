<?php

namespace App\Repositories\Contracts;

interface TransfersRepositoryInterface
{
    public function all();
    public function store();
    public function get_by_user_email();
    public function details($id);
    public function received();
    public function reimbursed_this_month();
    public function to_receive();
    public function transfers_today();
    public function change_status($id, $request);
    public function transfers_esta_semana();
    public function aumento_em_relacao_a_semana_passada();
    public function saldo_semanal();
    public function saldo_semana_passada($total = false, $start_week = null, $end_week = null);
    public function dados_grafico_receita();
    public function dados_grafico_receita_ano_passado();
    public function pago_mes_ano( $month, $year,$payment_method);
    public function transferencias_recentes($month, $year, $limit);
    public function saldo_semanal_em_dias($days);
    public function saldo_semana_passada_em_dias($date);
    public function paises();
    public function money_by_country($country);
    public function top_5_transacoes($month, $year, $limit, $min, $max);
    public function user_count_transactions($email, $prestacoes = null);
    public function user_total_payment($email, $payment_method = null);
    public function user_transaction_by_month($email, $month, $year);
    public function transaction_by_user($email);
}
