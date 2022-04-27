<?php

use App\Http\Controllers\AbonementController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaymentTipeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SendMoneyController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\TecnicoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::controller(SiteController::class)->group(function () {
    Route::get("/", "index")->name("home");
    Route::get("/about", "about")->name("about");
    Route::get("/send", "send")->name("send");
    Route::get("/help", "help")->name("help");
    Route::get("/contact", "contact")->name("contact");
    Route::get("/privacity", "privacity")->name("privacity");

    Route::middleware("send_money")->group(function () {
        Route::get("/identification", "identification")->name("identification");
        Route::get("/payment", "payment")->name("payment");
    });
});

Route::controller(BlogController::class)->group(function () {
    Route::prefix("blog")->group(function () {
        Route::get("/", "blog")->name("blog");
        Route::get("/{slug}", "post")->name("post");
        Route::get("/tag/{tag}", "tag")->name("tag");
    });
});



Route::get("success/{id}", [PaymentController::class, "response"])->name("stripeResponse");
Route::get("plans/success", [AbonementController::class, "success"])->name("plan_success");
Route::post('/payment', [PaymentTipeController::class, 'verificar_condição_de_pagamento'])->name('payment.post');


Route::controller(SendMoneyController::class)->group(function () {
    Route::post("/details", "details")->name("details");
    Route::post("/identification", "identification")->name("identification.submit");
});


Route::controller(ProfileController::class)->group(function () {
    Route::middleware(["user"])->group(function () {
        Route::prefix("user")->group(function () {
            Route::get("profile", "profille")->name("profile.dashboard");
            Route::post("/change_photo", "change_photo")->name("profile.change.photo");
            Route::get("transactions", "transactions")->name("profile.transactions");
            Route::get("settings", "settings")->name("profile.settings");
            Route::post("change_data", "profilleChangeDta")->name("profille.change.data");
            Route::post("transfer_details", "transfer_details")->name("profille.transfer_details");
        });
    });
});

Route::controller(TecnicoController::class)->group(function () {
    Route::middleware(["tecnico"])->group(function () {
        Route::prefix("tecnico")->group(function () {
            //tecnico.dashboard
            Route::get("dashboard", "dashboard")->name("tecnico.dashboard");
            Route::get("transactions", "transactions")->name("tecnico.transactions");
        });
    });
});

Route::middleware(["dashboard"])->group(function () {
    Route::get("dashboard", function () {
        return "memes";
    });
});

require __DIR__ . '/auth.php';
