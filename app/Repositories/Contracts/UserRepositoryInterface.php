<?php

namespace App\Repositories\Contracts;

use App\Http\Requests\ProfilleChangeData;

interface UserRepositoryInterface
{
    public function all();
    public function create($request);
    public function update_avatar($name);
    public function change_data(ProfilleChangeData $request);
    public function novos_usuarios_esse_mes();
    public function aumento_de_usuarios_em_relacao_aom_mes_passado();
    public function usuarios_mes_ano($month, $year, $limit);
    public function change_theme($theme);
    public function whereId($id);
    public function active_or_desactive_user($id);
    public function change_email($email_novo, $email);
    public function whereEmail($email);
}
