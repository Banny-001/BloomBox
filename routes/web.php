<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DemoController;
use App\Http\Controllers\FloristController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\MpesaController;
use Illuminate\Auth\Events\Authenticated;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RolesAndPermissionController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AccompanimentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PaymentController;
use App\Models\Accompaniment;
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

// Route::get('/', function () {
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('/login'),
//         'canRegister' => Route::has('/register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

// Route::get('/dashboard', function () {
//     return Inertia::render('Dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');



// require __DIR__.'/auth.php';
// Route::get ('/get-token' [MpesaController::class ,'get-token']);

Route::get('/', function () {
    return view('Home');
});
Route::get('/home',function(){
    return view('Home');
});


Route::get('/mpesa', function () {
    return view('Mpesa');
});
Route::get('/stk', function () {
    return view('stk');
});
Route::get('/invoice', function () {
    return view('invoice/invoice');
});
Route::get('/home',[UserController::class,'showChart']);
// Route::get('products', [ProductController::class, 'index']);
 Route::get('products', [ProductController::class, 'indexView']);
Route::get('products/create', [ProductController::class, 'create']);
Route::post('products/create', [ProductController::class, 'store']);
Route::get('products/{id}/edit', [ProductController::class, 'edit']);
Route::put('products/{id}/edit', [ProductController::class, 'update']);
Route::get('products/{id}/delete', [ProductController::class, 'destroy']);

Route::get('florists', [FloristController::class, 'index']);
Route::get('florists', [FloristController::class, 'indexView']);
Route::get('florists/create', [FloristController::class, 'create']);
Route::post('florists/create', [FloristController::class, 'store']);
Route::get('florists/{id}/edit', [FloristController::class, 'edit']);
Route::put('florists/{id}/edit', [FloristController::class, 'update']);
Route::get('florists/{id}/delete', [FloristController::class, 'destroy']);

Route::get('accompaniments', [AccompanimentController::class, 'index']);
Route::get('accompaniments' , [AccompanimentController::class, 'indexView']);
Route::get('accompaniments/create', [AccompanimentController::class, 'create']);
Route::post('accompaniments/create', [AccompanimentController::class, 'store']);
Route::get('accompaniments/{id}/edit', [AccompanimentController::class, 'edit']);
Route::put('accompaniments/{id}/edit', [AccompanimentController::class, 'update']);
Route::get('accompaniments/{id}/delete', [AccompanimentController::class, 'destroy']);

//orders
Route::get('orders',[OrderController::class,'index']);
Route::get('orders/create',[OrderController::class,'create']);
Route::get('orders/create',[OrderController::class,'store']);
Route::put('orders/{id}/edit',[OrderController::class,'update']);


//mpesa
Route::post('get-token', [MpesaController::class, 'getAccessToken']);
Route::post('register-urls', [MpesaController::class, 'registerURLS']);
Route::post('simulate', [MpesaController::class, 'simulateTransaction']);

Route::post('stkpush', [MpesaController::class, 'stkPush']);

//permissions
Route::get('add-permission',[RolesAndPermissionController::class,'addPermissions']);
Route::get('show-roles',[RolesAndPermissionController::class,'show']);
Route::get('create-roles',[RolesAndPermissionController::class,'createRole']);
Route::post('add-role',[RolesAndPermissionController::class,'create']);
Route::get('edit-role/{id}',[RolesAndPermissionController::class,'editRole']);
Route::put('update-role',[RolesAndPermissionController::class,'updateRole']);
Route::get('delete-role/{id}',[RolesAndPermissionController::class,'destroy']);

// Route::get('Auth/Login',[AuthenticatedSessionController::class ,'Auth/Login']);

Route::get('auth/google',[GoogleAuthController::class,'redirect'])->name('google-auth');
Route::get('auth/google/call-back',[GoogleAuthController::class,'callbackGoogle']);


