<?php

use App\Http\Controllers\AbonementController;
use App\Http\Controllers\AdminController;
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
    Route::middleware(["user", "verified"])->group(function () {
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
            Route::get("dashboard", "dashboard")->name("tecnico.dashboard");
            Route::get("transactions", "transactions")->name("tecnico.transactions");
            Route::get("transactions/{id}", "transaction_details")->name("tecnico.transaction.details");
            Route::post("change_status", "change_status")->name("tecnico.change.status");
        });
    });
});
Route::middleware("admin")->group(function () {
    Route::controller(AdminController::class)->group(function () {
        Route::prefix("admin")->group(function () {
            Route::get("/dashboard", "dashboard")->name("admin.dashboard");
            Route::get("/dashboard/stripe", "dashboard_stripe")->name("admin.dashboard.stripe");
            Route::get("/transactions", "transfers")->name("admin.transfers");
            Route::get("/transactions/{id}", "transaction_details")->name("admin.transaction.details");
            Route::get("/users", "users")->name("admin.users");
            Route::get("/users/{id}", "users_details")->name("admin.user.details");
            Route::post("/users/desactive/{id}", "users_desactive")->name("admin.user.desactive");
            Route::post("/users/verify-email/{id}", "users_verify_email")->name("admin.user.verify.email");
            Route::post("/users/chage-user_email_verify_secret-password", "verificar_senha_secreta")->name("admin.change.user.email.verify.secret.password");
            Route::post("/users/chage-user_email", "users_change_email")->name("admin.change.user.email");
            Route::get("/site/faq", "site_faq")->name("admin.site.faq");
            Route::post("/site/faq/create", "site_faq_create")->name("admin.site.faq.create");
            Route::post("/site/faq/delete", "site_faq_delete")->name("admin.site.faq.delete");
            Route::post("/site/faq/edit", "site_faq_edit")->name("admin.site.faq.edit");
            Route::post("/site/faq/edit/submit", "site_faq_edit_submit")->name("admin.site.faq.edit.submit");
            Route::get("/site/reviews", "site_reviews")->name("admin.site.reviews");

            Route::post("change_status", "change_status")->name("admin.change.status");
            Route::post("/change_theme", "change_theme")->name("admin.change_theme");
        });
    });
});


Route::middleware(["dashboard"])->group(function () {
    Route::get("dashboard", function () {
        return "memes";
    });
});

require __DIR__ . '/auth.php';
