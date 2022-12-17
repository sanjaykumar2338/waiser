<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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

Route::get('/', [HomeController::class, 'home']);
Route::get('/home', [HomeController::class, 'home']);
Route::get('/checkout', [HomeController::class, 'checkout']);
Route::get('/product', [HomeController::class, 'product']);
Route::get('/pago', [HomeController::class, 'pago']);
Route::get('/collection', [HomeController::class, 'collection']);
Route::get('/intergrantes', [HomeController::class, 'intergrantes']);
Route::get('/mi-cuenta', [HomeController::class, 'mi_cuenta']);
Route::get('/mis-inscripciones', [HomeController::class, 'mis_inscripciones']);
Route::get('/forget', [HomeController::class, 'forget']);
Route::get('/login', [HomeController::class, 'login']);
Route::post('/login_submit', [HomeController::class, 'login_submit']);
Route::get('/logout', [HomeController::class, 'logout']);