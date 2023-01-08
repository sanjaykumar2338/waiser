<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CouponController;

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
Route::get('/product/{data}/{station}/{package}/{member_id}/{title}', [HomeController::class, 'product']);
Route::get('/pago', [HomeController::class, 'pago']);
Route::get('/collection', [HomeController::class, 'collection']);
Route::get('/intergrantes', [HomeController::class, 'intergrantes']);
Route::get('/mi-cuenta', [HomeController::class, 'mi_cuenta']);
Route::get('/mis-inscripciones', [HomeController::class, 'mis_inscripciones']);
Route::get('/forget', [HomeController::class, 'forget']);
Route::get('/login', [HomeController::class, 'login']);
Route::post('/login_submit', [HomeController::class, 'login_submit']);
Route::get('/logout', [HomeController::class, 'logout']);

Route::get('/terms_condition', [HomeController::class, 'terms_condition']);
Route::get('/regulations', [HomeController::class, 'regulations']);

Route::post('/recovery_by_email', [HomeController::class, 'recovery_by_email']);
Route::post('/recovery_by_socio', [HomeController::class, 'recovery_by_socio']);


Route::post('/update_password', [UserController::class, 'update_password']);
Route::get('/my_account', [UserController::class, 'my_account']);
Route::get('/add_to_cart/{station}/{package}/{member_id}/{title}/{data}', [UserController::class, 'add_to_cart']);
Route::get('/add_to_cart_detail/{station}/{package}/{member_id}/{title}/{data}', [UserController::class, 'add_to_cart_detail']);

Route::get('/remove_cart/{id}', [UserController::class, 'remove_cart']);
Route::get('/course_selection/{id}', [UserController::class, 'course_selection']);
Route::get('/course_selection_part/{socio_id}/{title}/{dias?}/{sede?}', [UserController::class, 'course_selection_part']);
Route::post('submit_payment', [UserController::class, 'submit_payment']);
Route::get('online_payment', [UserController::class, 'online_payment']);

Route::get('/coupon/remove/{id}', [CouponController::class, 'coupon_remove']);
Route::get('/coupon/index/{secret}', [CouponController::class, 'index']);
Route::get('/coupon/add_coupon', [CouponController::class, 'add_coupon']);
Route::get('/coupon/edit/{id}', [CouponController::class, 'edit_coupon']);
Route::get('/coupon/delete/{id}', [CouponController::class, 'delete_coupon']);
Route::post('/coupon/save', [CouponController::class, 'save']);
Route::post('/coupon/update/{id}', [CouponController::class, 'update']);

Route::post('/apply_coupon',[CouponController::class,'applyCoupon']);


Route::get('send_test_email', function(){
	Mail::raw('Sending emails with Mailgun and Laravel is easy!', function($message)
	{
		$message->to('sk963070@gmail.com');
	});
});