<?php

use Illuminate\Support\Facades\Route;


Route::middleware(["superior"])->group(function () {

Route::get("/dashboard", function () {
    return "memes";
})->name("admin.dashboard");
});


// Route::middleware(["dashboard"])->group(function () {
//     Route::get("dashboard", function () {
//         return "memes";
//     })->name("admin.dashboard");
// });

require __DIR__ . '/auth.php';
