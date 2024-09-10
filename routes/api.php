<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AccompanimentController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\FloristController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\MpesaResponsesController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Models\Accompaniment;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\WebhookController;
use App\Http\Controllers\MpesaController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resources([
          
           'products'=>ProductController::class,
           'accompaniments'=>AccompanimentController::class,
           'florists'=>FloristController::class
]);
Route::post('pay/order',[PaymentController::class,'payByStripe']);

Route::post('validation',[MpesaResponsesController::class,'validation']);
Route::post('confirmation',[MpesaResponsesController::class,'confirmation']);
Route::post('simulate',[MpesaResponsesController::class,'simulateTransaction']);
Route::post('/stkpush',[MpesaResponsesController::class,'stkpush']);
//stripe
Route::post('/payment-success',[PaymentController::class,'success']);
Route::post('/payment-cancel',[PaymentController::class,'cancel']);
Route::post('/complete-payment', [PaymentController::class, 'completePayment']);
Route::post('/checkout',[PaymentController::class,'checkout']);
Route::post('/stripe/webhook', [WebhookController::class, 'handleStripeWebhook']);

Route::post('orders', [OrderController::class, 'store']);
Route::post('orders/create', [OrderController::class, 'store']);



Route::post('Auth/Register' ,[RegisteredUserController::class,'Auth/register']);
// Route ::post('/register',[RegisterController::class,'store']);

Route::post('/user-register',[AuthController::class,'register']);
Route::post('/user-login',[AuthController::class,'login']);
//google login


