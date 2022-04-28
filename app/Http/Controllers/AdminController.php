<?php

namespace App\Http\Controllers;

use App\Repositories\Contracts\TransfersRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct(public TransfersRepositoryInterface $transfers,public UserRepositoryInterface $users)
    {
        $this->middleware('admin');
    }


    public function dashboard()
    {
        $transfers_esta_semana = $this->transfers->transfers_esta_semana();
        $aumento_em_relacao_a_semana_passada = (float)$this->transfers->aumento_em_relacao_a_semana_passada();
        $novos_usuarios_esse_mes = (int)$this->users->novos_usuarios_esse_mes();
        $aumento_de_usuarios_em_relacao_aom_mes_passado = (float)$this->users->aumento_de_usuarios_em_relacao_aom_mes_passado();
        dd($aumento_de_usuarios_em_relacao_aom_mes_passado);


        return view("admin.dashboard",compact("transfers_esta_semana","aumento_em_relacao_a_semana_passada","novos_usuarios_esse_mes"));
    }
}
