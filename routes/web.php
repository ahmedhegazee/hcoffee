<?php

use App\Http\Controllers\FrontController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HomePageSettingController;
use App\Http\Controllers\IntervalController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\SettingController;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
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

Route::get("/test", [FrontController::class, "test"]);
Auth::routes(['register' => false, 'reset' => false]);
Route::get('/whats', [HomeController::class, "sendWhatsMessage"]);
Route::prefix('dashboard')->middleware('auth')->name('admin.')->group(function () {
    Route::get('/', [HomeController::class, "index"])->name('home');

    Route::get("/reservations", [ReservationController::class, "index"])->name('reservation.index');
    Route::put("/reservations", [ReservationController::class, "update"])->name('reservation.update');
    Route::get("/setting", [SettingController::class, "index"])->name('setting.index');
    Route::put("/setting/{setting}", [SettingController::class, "update"])->name('setting.update');
    Route::get("/home_page_setting", [HomePageSettingController::class, "index"])->name('home_page_setting.index');
    Route::put("/home_page_setting", [HomePageSettingController::class, "update"])->name('home_page_setting.update');
    Route::resource("interval", IntervalController::class)->only(['index', 'update']);
});
Route::get("/price", [FrontController::class, 'getPrice']);
Route::get("payment-success", [FrontController::class, "showPaymentStatus"])->name("welcome");
Route::post("reservation", [FrontController::class, "makeOrder"]);

Route::view("/", 'main');