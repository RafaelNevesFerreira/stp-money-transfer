<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Http\Requests\ProfilleChangeData;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\TransfersRepositoryInterface;
use App\Repositories\Contracts\NotificationsRepositoryInterface;

class ProfileController extends Controller
{
    public function __construct(
        public TransfersRepositoryInterface $transfers,
        public UserRepositoryInterface $user,
        public NotificationsRepositoryInterface $notifications
    ) {
    }
    public function profille()
    {
        $transfers  = $this->transfers->get_by_user_email();

        return view("profile.profille", compact("transfers"));
    }

    public function notifications()
    {
        $notifications = $this->notifications->whereId(Auth::user()->id);
        return view("profile.notifications", compact("notifications"));
    }

    public function settings()
    {
        return view("profile.settings");
    }

    public function transactions()
    {
        $transfers  = $this->transfers->get_by_user_email();

        return view("profile.transactions", compact("transfers"));
    }

    public function invoice($id)
    {
        $details = $this->transfers->details($id);
        return view("profile.invoice", compact("details"));
    }

    public function transfer_details(Request $request)
    {
        $request->validate([
            "id" => "required|numeric|min:0"
        ]);
        $details = $this->transfers->details($request->id);
        return $details;
    }

    public function change_photo(Request $request)
    {
        $path = "/images/profile/";
        $file = $request->file("file");
        $new_name = "UIMG" . date('Ymd') . uniqid() . ".jpg";

        $upload = $file->move(public_path($path), $new_name);

        if (!$upload) {
            return response()->json(["status" => 0, "msg" => "algo de erado aconteceu"]);
        } else {

            $old_picture = Auth::user()->avatar;
            if ($old_picture != "") {
                if (File::exists(public_path($path . $old_picture))) {
                    File::delete(public_path($path . $old_picture));
                };
            }

            $update = $this->user->update_avatar($new_name);


            return response()->json(["status" => 1, "msg" => "imagem actualizada com sucesso"]);
        }
    }

    public function profilleChangeDta(ProfilleChangeData $request)
    {
        try {
            if ($request->has("email")) {
                $this->user->change_email($request->email, Auth::user()->email);
            } else {
                $this->user->change_data($request);
            }
            return redirect()->back()->with(["message" => "Atualizações feitas com sucesso", "status" => 200]);
        } catch (\Throwable $th) {
            return redirect()->back()->with(["message" => "Erro ao tentar salvar as mudançã, tente mais tarde", "status" => 500]);
        }
    }
}
