<?php
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TenantController;
use App\Http\Controllers\VoucherController;
use App\Http\Controllers\InvoiceController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/customers', [CustomerController::class, 'index']);
Route::get('/customers/{id}', [CustomerController::class, 'show']);
Route::post('/customers', [CustomerController::class, 'store']);
Route::put('/customers/{id}', [CustomerController::class, 'update']);
Route::delete('/customers/{id}', [CustomerController::class, 'destroy']);

// Tenants
Route::get('/tenants', [TenantController::class, 'index']);
Route::get('/tenants/{id}', [TenantController::class, 'show']);
Route::post('/tenants', [TenantController::class, 'store']);
Route::put('/tenants/{id}', [TenantController::class, 'update']);
Route::delete('/tenants/{id}', [TenantController::class, 'destroy']);

// Vouchers
Route::post('/vouchers/redeem', [VoucherController::class, 'redeem']);

// Invoices
Route::get('/invoices', [InvoiceController::class, 'index']);
Route::get('/invoices/{id}', [InvoiceController::class, 'show']);
Route::post('/invoices', [InvoiceController::class, 'create']);
Route::put('/invoices/{id}', [InvoiceController::class, 'update']);
Route::delete('/invoices/{id}', [InvoiceController::class, 'destroy']);
