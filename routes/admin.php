<?php

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

Route::controller(TecnicoController::class)->group(function () {
    Route::get("dashboard", "dashboard")->name("tecnico.dashboard");
    Route::get("transactions", "transactions")->name("tecnico.transactions");
    Route::get("transactions/{id}", "transaction_details")->name("tecnico.transaction.details");
    Route::post("change_status", "change_status")->name("tecnico.change.status");
});

require __DIR__ . '/auth.php';
