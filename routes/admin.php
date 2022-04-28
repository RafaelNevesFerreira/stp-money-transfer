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

Route::middleware("admin")->group(function () {
    Route::get("/dashboard", function () {
        return "memes";
    })->name("admin.dashboard");
});

// Route::middleware(["dashboard"])->group(function () {
//     Route::get("dashboard", function () {
//         return "memes";
//     })->name("admin.dashboard");
// });

// require __DIR__ . '/auth.php';
