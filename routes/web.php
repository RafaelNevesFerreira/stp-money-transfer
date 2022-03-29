<?php

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

Route::controller(SiteController::class)->group(function(){
    Route::get("/","index")->name("home");
    Route::get("/about","about")->name("about");
    Route::get("/send","send")->name("send");
    Route::get("/identification","identification")->name("identification");
});

Route::controller(SendMoneyController::class)->group(function(){
    Route::post("/details","details")->name("details");
    // Route::get("/about","about")->name("about");
    // Route::get("/send","send")->name("send");
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';
