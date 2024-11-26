<?php


use App\Http\Controllers\MpesaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GoogleAuthController;
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






// Route::get ('/get-token' [MpesaController::class ,'get-token']);





Route::any('{url}', function () {
    return view('index');
})->where('url', '^(?!api).*$');


Route::get('/mpesa', function () {
    return view('Mpesa');
});
Route::get('/stk', function () {
    return view('payment/stk');
});
Route::get('/invoice', function () {
    return view('invoice/invoice');
});
Route::get('/home', [UserController::class, 'showChart']);

//mpesa
Route::post('get-token', [MpesaController::class, 'getAccessToken']);
Route::post('register-urls', [MpesaController::class, 'registerURLS']);
Route::post('simulate', [MpesaController::class, 'simulateTransaction']);

Route::post('stkpush', [MpesaController::class, 'stkpush']);

Route::post('login', [AuthController::class, 'sessionLogin']);
// Route::get('Auth/Login',[AuthenticatedSessionController::class ,'Auth/Login']);

Route::get('auth/google', [GoogleAuthController::class, 'redirect'])->name('google-auth');
Route::get('auth/google/call-back', [GoogleAuthController::class, 'callbackGoogle']);
