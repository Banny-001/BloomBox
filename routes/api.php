<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    RegisterController,
    LoginController,
    ProductController,
    AccompanimentController,
    CheckoutController,
    FloristController,
    ItemController,
    MpesaResponsesController,
    PaymentController,
    ProfileController,
    OrderController,
    WebhookController,
    GoogleAuthController,
    MpesaController,
    RolesAndPermissionController
};

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

// Public Routes
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('user-register', [AuthController::class, 'register']);
Route::post('google-auth', [GoogleAuthController::class, 'googleAuth']);
Route::get('products', [ProductController::class, 'index']);

// Secured Routes with auth:sanctum Middleware
Route::group(['middleware' => ['auth:sanctum']], function () {

    Route::post('user-logout', [AuthController::class, 'logout']);
    //profile
    Route::get('/profile', [ProfileController::class, 'fetchProfile']);
    // Route::put('/update-phone', [ProfileController::class, 'updatePhone']);
    Route::post('/upload-profile-image', [ProfileController::class, 'uploadProfileImage']);

    //products
 
    Route::post('products', [ProductController::class, 'store']);
    Route::put('products/{id}', [ProductController::class, 'update']);
    Route::delete('products/{id}', [ProductController::class, 'destroy']);
    Route::get('products/{id}', [ProductController::class, 'edit']);

    //florists
    Route::get('florists', [FloristController::class, 'index']);
    Route::get('florists', [FloristController::class, 'indexView']);
    Route::get('florists/create', [FloristController::class, 'create']);
    Route::post('florists/create', [FloristController::class, 'store']);
    Route::get('florists/{id}/edit', [FloristController::class, 'edit']);
    Route::put('florists/{id}/edit', [FloristController::class, 'update']);
    Route::get('florists/{id}/delete', [FloristController::class, 'destroy']);

    //accompaniments
    Route::get('accompaniments', [AccompanimentController::class, 'index']);
    Route::get('accompaniments', [AccompanimentController::class, 'indexView']);
    Route::get('accompaniments/create', [AccompanimentController::class, 'create']);
    Route::post('accompaniments/create', [AccompanimentController::class, 'store']);
    Route::get('accompaniments/{id}/edit', [AccompanimentController::class, 'edit']);
    Route::put('accompaniments/{id}/edit', [AccompanimentController::class, 'update']);
    Route::get('accompaniments/{id}/delete', [AccompanimentController::class, 'destroy']);



    //orders
    Route::get('orders', [OrderController::class, 'index']);
    Route::get('orders/create', [OrderController::class, 'create']);
    Route::get('orders/create', [OrderController::class, 'store']);
    Route::put('orders/{id}/edit', [OrderController::class, 'update']);
    Route::post('orders', [OrderController::class, 'store']);

    //permissions
    Route::get('add-permission', [RolesAndPermissionController::class, 'addPermissions']);
    Route::get('show-roles', [RolesAndPermissionController::class, 'show']);
    Route::get('create-roles', [RolesAndPermissionController::class, 'createRole']);
    Route::post('add-role', [RolesAndPermissionController::class, 'create']);
    Route::get('edit-role/{id}', [RolesAndPermissionController::class, 'editRole']);
    Route::put('update-role', [RolesAndPermissionController::class, 'updateRole']);
    Route::get('delete-role/{id}', [RolesAndPermissionController::class, 'destroy']);

    // Payment Routes
    Route::post('pay/order', [PaymentController::class, 'payByStripe']);
    Route::post('/payment-success', [PaymentController::class, 'success']);
    Route::post('/payment-cancel', [PaymentController::class, 'cancel']);
    Route::post('/complete-payment', [PaymentController::class, 'completePayment']);
    Route::post('/checkout', [PaymentController::class, 'checkout']);

    // Mpesa Routes
    Route::post('validation', [MpesaResponsesController::class, 'validation']);
    Route::post('confirmation', [MpesaResponsesController::class, 'confirmation']);
    Route::post('simulate', [MpesaResponsesController::class, 'simulateTransaction']);
    Route::post('/stkpush', [MpesaResponsesController::class, 'stkpush']);

    // Stripe Webhook
    // Route::post('/stripe/webhook', [WebhookController::class, 'handleStripeWebhook']);
});
