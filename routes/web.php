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

Auth::routes(['register' => false, 'reset' => false]);

Route::prefix('dashboard')->middleware('auth')->name('admin.')->group(function () {
    Route::get('/', [HomeController::class, "index"])->name('home');
    Route::resource("slider", HomeImagePageController::class)->except(['show']);
    Route::prefix("product")->group(function () {
        Route::resource("category", ProductCategroyController::class)->except(['show']);
        Route::resource("{product}/attribute", ProductAttributeController::class)->except(['show']);
        Route::resource("product", ProductController::class)->except(["show"]);
        Route::resource("{product}/image", ProductImageController::class)->except(["show"]);
    });
});
Route::get('/404', fn () => view('errors.404'));
Route::get('/401', fn () => view('errors.401'));
Route::get('/403', fn () => view('errors.403'));
Route::get('/419', fn () => view('errors.419'));
Route::get('/429', fn () => view('errors.429'));
Route::get('/500', fn () => view('errors.500'));
Route::get('/503', fn () => view('errors.503'));

Route::get('{any}', function () {
    return view('main');
})->where('any', '.*');