<?php

namespace App\Repositories\Eloquent;

use App\Http\Requests\ProfilleChangeData;
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

    public function change_data(ProfilleChangeData $request)
    {
        $this->model::where("id", Auth::user()->id)->update([
            "name" => $request->nome,
            "country" => $request->pais,
            "address" => $request->morada,
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

    public function usuarios_mes_ano($month, $year, $limit)
    {

        return $this->model::whereMonth("created_at", $month)->whereYear("created_at", $year)->latest()->limit($limit)->get();
    }

    public function change_theme($theme)
    {
        $this->model::where("id", Auth::user()->id)
            ->update(["theme_color" => $theme]);
    }

    public function active_or_desactive_user($id)
    {
        $status = $this->model::where("id", $id)->first("status");

        if ($status->status === 0) {
            $this->model::where("id", $id)->update([
                "status" => 1
            ]);
        } else {
            $this->model::where("id", $id)->update([
                "status" => 0
            ]);
        }
    }

    public function change_email($email_novo, $email)
    {
        $this->model::where("email", $email)->firstOrFail()->update([
            "email" => $email_novo,
            "email_verified_at" => null,
        ]);
    }

    public function all()
    {
        return $this->model::where("role", 1)->get();
    }
}
