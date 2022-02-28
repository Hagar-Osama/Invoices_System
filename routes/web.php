<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\InvoiceDetailController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\ProductController;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::group(['middleware' => 'auth'], function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index');
    Route::post('/signout', [AuthController::class, 'signout'])->name('signout');
    ///Department Routes///
    Route::get('departments', [DepartmentController::class, 'index'])->name('departments.index');
    Route::post('departments/store', [DepartmentController::class, 'store'])->name('departments.store');
    Route::put('departments/update', [DepartmentController::class, 'update'])->name('departments.update');
    Route::delete('departments/delete', [DepartmentController::class, 'delete'])->name('departments.destroy');
    ///Products Routes///
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
    Route::put('/products/update', [ProductController::class, 'update'])->name('products.update');
    Route::delete('/products/delete', [ProductController::class, 'destroy'])->name('products.destroy');

    ///Invoices Routes///
    Route::get('/invoices', [InvoicesController::class, 'index'])->name('invoices.index');
    Route::get('/invoices/create', [InvoicesController::class, 'create'])->name('invoices.create');
    Route::get('/section/{id}', [InvoicesController::class, 'getProduct']);
    Route::post('/invoices/store', [InvoicesController::class, 'store'])->name('invoices.store');
    //invoice Details Route
    Route::get('/invoiceDetails/{id}', [InvoiceDetailController::class, 'index'])->name('invoiceDetails.index');
});
Route::get('/signin', [AuthController::class, 'signinPage'])->name('signinpage');
Route::post('/signin', [AuthController::class, 'signin'])->name('signin');
