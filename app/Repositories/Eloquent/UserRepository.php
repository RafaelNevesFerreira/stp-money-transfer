<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserRepository extends AbstractRepository implements UserRepositoryInterface
{

    public function __construct(public User $model)
    {
    }

    public function update_avatar($name)
    {
        $this->model::where("id", Auth::user()->id)->update([
            "avatar" => $name
        ]);
    }

    public function novos_usuarios_esse_mes()
    {
        return  $this->model::whereMonth('created_at', '=', date("m"))->count();
    }

    public function aumento_de_usuarios_em_relacao_aom_mes_passado(): float
    {
        $mes_pasado = $this->model::whereMonth('created_at', '=', Carbon::now()->subMonth()->month)->count();

        $valor_inicial = $mes_pasado;
        $valor_final = $this->novos_usuarios_esse_mes();

        if ($valor_inicial > 0) {
            $diferença = ($valor_final - $valor_inicial) / $valor_inicial * 100;
        } else {
            $diferença = 0;
        }

        return $diferença;
    }

    public function usuarios_mes_ano($month, $year,$limit)
    {
        return $this->model::whereMonth("created_at", $month)->whereYear("created_at", $year)->latest()->limit($limit)->get();
    }
}
