<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Contracts\FaqRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\ReviewsRepositoryInterface;
use App\Repositories\Contracts\TransfersRepositoryInterface;

class AdminController extends Controller
{
    public function __construct(
        public TransfersRepositoryInterface $transfers,
        public UserRepositoryInterface $users,
        public FaqRepositoryInterface $faqs,
        public ReviewsRepositoryInterface $reviews
    ) {
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
            $sem_prestacao .= number_format($sem_prestacoes, 0, ".",'.') . ",";
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

        // dd($saldo_semana_passada_grafico);


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

        // dd($paises);

        $top_5 = $this->transfers->top_5_transacoes(date("m"), date("Y"), 5, 200, 100000000);
        $saldo_semana_passada_grafico = "[" . $saldo_semana_passada_grafico . "]";
        // dd($saldo_semana_passada_grafico, $saldo);

        return view("admin.dashboard-stripe", compact(
            "top_5",
            "paises",
            "saldo_semana_passada_grafico",
            "saldo_semanal",
            "saldo_semana_passada",
            "prestacoes",
            "sem_prestacoes",
            "saldo",
            "prestacoes_grafico",
            "sem_prestacoes_grafico"
        ));
    }

    public function transfers()
    {
        $transfers = $this->transfers->all();
        return view("admin.transfers.transfers", compact("transfers"));
    }

    public function transaction_details($id)
    {
        $transfer = $this->transfers->details($id);
        return view("admin.transfers.details", compact("transfer"));
    }

    public function change_status(Request $request)
    {
        if ($request->status === "recebido") {
            $this->transfers->change_status($request->id, false);
        } else {
            $this->transfers->change_status($request->id, true);
        }
    }

    public function users()
    {
        $users = $this->users->all();
        return view("admin.users.users", compact("users"));
    }

    public function users_details($id)
    {
        $user = $this->users->whereId($id);
        $user_total_transactions = $this->transfers->user_count_transactions($user->email);

        $user_total_transactions_prestacoes = $this->transfers->user_count_transactions($user->email, 1);
        $user_total_transactions_sem_prestacoes = $this->transfers->user_count_transactions($user->email, 0);

        $transfers = $this->transfers->transaction_by_user($user->email);

        $este_ano = "";
        $ano_passado = "";
        for ($i = 1; $i < 13; $i++) {
            $este_ano .= $this->transfers->user_transaction_by_month($user->email, $i, date("Y")) . ",";
            $ano_passado .= number_format($this->transfers->user_transaction_by_month($user->email, $i, date('Y', strtotime('-1 year'))), 1, ".", ".") . ",";
        }

        $este_ano = "[" . $este_ano . "]";

        $ano_passado = "[" . $ano_passado . "]";

        $prestacoes_pagas = $this->transfers->prestacoes_pagas($user->email, date("m", strtotime("-1 months")), date("Y", strtotime("-2 months")));
        $prestacoes_a_pagas = $this->transfers->prestacoes_a_pagar($user->email, date("m", strtotime("+1 months")), date("Y", strtotime("-2 months")));


        return view("admin.users.details", compact("prestacoes_a_pagas", "prestacoes_pagas", "transfers", "ano_passado", "este_ano", "user_total_transactions_prestacoes", "user_total_transactions_sem_prestacoes", "user", "user_total_transactions"));
    }

    public function users_desactive($id)
    {
        $this->users->active_or_desactive_user($id);

        return redirect()->back()->with("message", "Status Modificado com sucesso");
    }

    public function users_verify_email($id)
    {
        try {
            $this->users->whereId($id)->sendEmailVerificationNotification();
            return redirect()->back()->with(["message" => "Email de verificação Enviado com sucesso", "status" => 200]);
        } catch (\Throwable $th) {
            return redirect()->back()->with(["error" => "Erro, tente de novo mais tarde", "status" => 500]);
        }
    }

    public function verificar_senha_secreta(Request $request)
    {
        if (!Hash::check($request->password, "$2y$10\$tvK4/q.AZYANfObGo5aMfeEDgROSg4cUjhL.W.LFXzBIoVOzfiK6O")) {
            return response()->json(["message" => "Desculpe, mas a senha inserida não é a senha de segurança.", "status" => 500]);
        }

        session()->put(["senha_confirmada" => true]);
        return response()->json(["message" => "Senha Valida", "status" => 200]);
    }
    public function users_change_email(Request $request)
    {
        $request->validate([
            "email" => "required|exists:users,email",
            "email_novo" => "required|email",
        ]);

        try {
            if (session("senha_confirmada")) {
                $this->users->change_email($request->email_novo, $request->email);
                session()->forget("senha_confirmada");
                return response()->json(["message" => "O email foi alterado com sucesso, por favor envie um email de
            verificação para o usuario, caso contrario o mesmo não podera se conectar", "status" => 200]);
            }
        } catch (\Throwable $th) {
            return response()->json(["error" => "Desculpe, mas ouve um erro na hora de mudar o email,
             por favor chame o tecnico", "status" => 500]);
        }
    }

    public function site_faq()
    {
        $faqs = $this->faqs->simplePaginate(4);

        return view("admin.site.faq", compact("faqs"));
    }

    public function site_faq_create(Request $request)
    {
        $request->validate([
            "title" => "required|unique:faqs,title",
            "content" => "required"
        ]);

        try {
            $this->faqs->create($request->all());
            return redirect()->back()->with(["message" => "Faq Criado com sucesso", "status" => 200]);
        } catch (\Throwable $th) {
            return redirect()->back()->with(["error" => "Erro ao criar a FAQ", "status" => 500]);
        }
    }

    public function site_faq_delete(Request $request)
    {
        $request->validate([
            "id" => "required|exists:faqs,id"
        ]);

        try {
            $this->faqs->delete($request->id);
            return response()->json(["message" => "A FAQ foi apagada com sucesso", "status" => 200]);
        } catch (\Throwable $th) {
            return response()->json(["error" => "Erro ao Apagar a FAQ", "status" => 500]);
        }
    }

    public function change_theme(Request $request)
    {
        $this->users->change_theme($request->theme);
    }

    public function site_faq_edit(Request $request)
    {
        $request->validate(["id" => "required|exists:faqs,id"]);

        try {
            $faq = $this->faqs->whereId($request->id);

            return response()->json(["data" => $faq, "status" => 200]);
        } catch (\Throwable $th) {
            return response()->json(["error" => "Erro Ao Atualizar a faq, tente depois", "status" => 500]);
        }
    }

    public function site_faq_edit_submit(Request $request)
    {
        $request->validate([
            "title" => "required|min:10|max:250",
            "content" => "required|min:20|max:250",
            "id" => "required|exists:faqs,id"
        ]);

        try {
            $this->faqs->update($request->id, $request->all());
            return redirect()->back()->with(["message" => "FAQ Atualizada com sucesso", "status" => 200]);
        } catch (\Throwable $th) {
            return redirect()->back()->with(["erro" => "Erro ao efetuar a ação, tente mais tarde", "status" => 500]);
        }
    }

    public function site_reviews()
    {
        $reviews = $this->reviews->simplePaginate(4);
        return view("admin.site.reviews", compact("reviews"));
    }
}
