<?php

use App\Http\Controllers\FrontController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReservationController;
use App\Models\Reservation;
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



Auth::routes(['register' => false, 'reset' => false]);

Route::prefix('dashboard')->middleware('auth')->name('admin.')->group(function () {
    Route::get('/', [HomeController::class, "index"])->name('home');
    Route::get("/reservations", [ReservationController::class, "index"])->name('reservation.index');
    Route::put("/reservations", [ReservationController::class, "update"])->name('reservation.update');
});
Route::get('/404', fn () => view('errors.404'));
Route::get('/401', fn () => view('errors.401'));
Route::get('/403', fn () => view('errors.403'));
Route::get('/419', fn () => view('errors.419'));
Route::get('/429', fn () => view('errors.429'));
Route::get('/500', fn () => view('errors.500'));
Route::get('/503', fn () => view('errors.503'));
Route::get("payment-success/{reservation}", [FrontController::class, "showPaymentStatus"])->name("welcome");
Route::post("reservation", [FrontController::class, "makeOrder"]);
Route::get('{any}', function () {
    return view('main');
})->where('any', '.*');