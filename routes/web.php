<?php

use App\Http\Controllers\AbonementController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PaymentTipeController;
use App\Http\Controllers\SendMoneyController;
use App\Http\Controllers\SiteController;
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
Route::get("success/plans", [AbonementController::class, "success"])->name("plan_success");
Route::post('/payment', [PaymentTipeController::class, 'verificar_condição_de_pagamento'])->name('payment.post');


Route::controller(SendMoneyController::class)->group(function () {
    Route::post("/details", "details")->name("details");
    Route::post("/identification", "identification")->name("identification.submit");
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
