<?php

namespace App\Repositories\Eloquent;

use App\Jobs\MoneyStatus;
use App\Models\Notification;
use App\Models\User;
use App\Repositories\Contracts\NotificationsRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;

class NotificationsRepository implements NotificationsRepositoryInterface
{
    public function __construct(public Notification $model, public UserRepositoryInterface $users)
    {
    }

    public function whereId($id)
    {
        return $this->model::where("users_id", $id)->latest()->get();
    }

    public function save($transfer)
    {
        try {
            $users = $this->users->whereEmail($transfer->email);
            if ($transfer->status === "received") {
                $this->model::create([
                    "title" => "Dinheiro Recebido",
                    "content" => "O seu dinheiro foi levantado com sucesso no dia" . date("d/m/Y"),
                    "users_id" => $users->id
                ]);
                MoneyStatus::dispatch("received", $users)->delay(now()->addSecond(10));
            } else {
                $this->model::create([
                    "title" => "Dinheiro Reembolsado",
                    "content" => "O seu dinheiro foi reembolsado com sucesso no dia" . date("d/m/Y") . ". Obrigado pela confiança",
                    "users_id" => $users->id
                ]);
                MoneyStatus::dispatch("reimbursed", $users)->delay(now());
            }
        } catch (\Throwable $th) {
        }
    }
}
