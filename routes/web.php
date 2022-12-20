<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

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

Route::post('/recovery_by_email', [HomeController::class, 'recovery_by_email']);
Route::post('/recovery_by_socio', [HomeController::class, 'recovery_by_socio']);

Route::get('/my_account', [UserController::class, 'my_account']);

Route::get('send_test_email', function(){
	Mail::raw('Sending emails with Mailgun and Laravel is easy!', function($message)
	{
		$message->to('sk963070@gmail.com');
	});
});