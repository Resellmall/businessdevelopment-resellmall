<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\DashboardController;

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

Route::get('/', function () {
    if (session()->has('userId')) {
        return redirect('dashboard');
    }
    return view('login.login');
});
Route::post('login', [UserController::class, 'login']);

Route::group(['middleware' => ['isLogged']], function () {
    Route::get('logout', [UserController::class, 'logout'])->name('logout');
    Route::get('dashboard', [DashboardController::class, 'index']);

    Route::get('supplier', [SupplierController::class, 'list'])->name('supplier.list');
    Route::get('supplier/create', [SupplierController::class, 'create'])->name('supplier.create');
    Route::post('supplier/profile', [SupplierController::class, 'profile']);
    Route::post('supplier/kyc', [SupplierController::class, 'kyc']);
    Route::post('supplier/bank', [SupplierController::class, 'bank']);
    Route::post('supplier/shipment', [SupplierController::class, 'shipment']);
    Route::post('supplier/address', [SupplierController::class, 'address']);
    Route::post('supplier/business', [SupplierController::class, 'business']);
    Route::get('supplier/edit/{id}', [SupplierController::class, 'edit']);
    Route::delete('supplier/delete', [SupplierController::class, 'delete']);
    Route::post('supplier/view', [SupplierController::class, 'view']);
    Route::post('supplier/updateProfile', [SupplierController::class, 'updateProfile']);
    Route::post('supplier/updateKyc', [SupplierController::class, 'updateKyc']);
    Route::post('supplier/updateBank', [SupplierController::class, 'updateBank']);
    Route::post('supplier/updateShipment', [SupplierController::class, 'updateShipment']);
    Route::post('supplier/updateAddress', [SupplierController::class, 'updateAddress']);
    Route::post('supplier/updateBusiness', [SupplierController::class, 'updateBusiness']);


    Route::get('inventory', function () {
        return view('inventory.list');
    });
});
