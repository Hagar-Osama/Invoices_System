<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerReportController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\InvoiceAttachmentController;
use App\Http\Controllers\InvoiceDetailController;
use App\Http\Controllers\InvoicesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Interfaces\InvoicesInterface;
use App\Models\Invoice;
use App\Models\User;
use App\Notifications\AddedInvoice;
use App\Notifications\newInvoiceAdded;
use Illuminate\Support\Facades\Notification;
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
Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin.index')->middleware('isActive');
    Route::post('/signout', [AuthController::class, 'signout'])->name('signout');

    ///Invoices Routes///
    Route::get('/invoice', [InvoicesController::class, 'index'])->name('invoices.index');
    Route::get('/invoices/create', [InvoicesController::class, 'create'])->name('invoices.create');
    Route::get('/department/{id}', [InvoicesController::class, 'getProduct']);
    Route::post('/invoices/store', [InvoicesController::class, 'store'])->name('invoices.store');
    Route::get('invoice/edit/{id}', [InvoicesController::class, 'edit'])->name('invoice.edit');
    Route::put('invoices/update', [InvoicesController::class, 'update'])->name('invoice.update');
    Route::delete('invoice/delete', [InvoicesController::class, 'destroy'])->name('invoice.destroy');
    Route::get('invoiceStatus/{invoiceId}', [InvoicesController::class, 'showStatus'])->name('invoiceStatus.show');
    Route::put('invoiceStatus/update', [InvoicesController::class, 'updateInvoiceStatus'])->name('invoiceStatus.update');
    Route::get('paidInvoices', [InvoicesInterface::class, 'showPaidInvoices'])->name('paidInvoices.index');
    Route::get('unpaidInvoices', [InvoicesInterface::class, 'showUnpaidInvoices'])->name('unpaidInvoices.index');
    Route::get('partlyPaidInvoices', [InvoicesInterface::class, 'showPartlyPaidInvoices'])->name('partlyPaidInvoices.index');
    Route::get('archivedInvoices', [ArchiveController::class, 'showArchivedInvoices'])->name('archivedInvoices.index');
    Route::delete('invoice/archive', [InvoicesController::class, 'archiveInvoices'])->name('invoices.archive');
    Route::put('archives/update', [ArchiveController::class, 'updateArchives'])->name('archive.update');
    Route::delete('archive/delete', [ArchiveController::class, 'destroy'])->name('archive.destroy');
    Route::get('invoice/print/{invoiceId}', [InvoicesController::class, 'showInvoicePrintPage'])->name('printInvoice.index');
    Route::get('invoices/excel', [InvoicesController::class, 'export'])->name('invoices.export');

    //invoice Details Route
    Route::get('/invoiceDetails/{invoiceId}', [InvoiceDetailController::class, 'index'])->name('invoiceDetails.index');

    //invoice Attachment Routes
    Route::get('invoiceAttachments/{invoiceNumber}/{fileName}', [InvoiceAttachmentController::class, 'openFile'])->name('openFile');
    Route::get('invoiceAttachment/{invoiceNumber}/{fileName}', [InvoiceAttachmentController::class, 'downloadFile'])->name('downloadFile');
    Route::delete('attachment/delete', [InvoiceAttachmentController::class, 'destroy'])->name('attachment.destroy');
    Route::post('invoiceAttachment/store', [InvoiceAttachmentController::class, 'store'])->name('attachment.store');

    //Reports Routes
    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
    Route::post('reports/search', [ReportController::class, 'search'])->name('reports.search');
    Route::get('customers/report', [CustomerReportController::class, 'index'])->name('customers.index');
    Route::post('customers/search', [CustomerReportController::class, 'search'])->name('customers.search');

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

    ///Users Route///
    Route::get('users', [UserController::class, 'index'])->name('users.index');
    Route::get('users/show/{id}', [UserController::class, 'show'])->name('users.show');
    Route::get('users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('users/store', [UserController::class, 'store'])->name('users.store');
    Route::get('users/edit/{id}', [UserController::class, 'edit'])->name('users.edit');
    Route::put('users/update/{id}', [UserController::class, 'update'])->name('users.update');
    Route::delete('users/delete', [UserController::class, 'destroy'])->name('users.destroy');

    ///roles Route////
    Route::get('roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('roles/show/{id}', [RoleController::class, 'show'])->name('roles.show');
    Route::get('roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('roles/store', [RoleController::class, 'store'])->name('roles.store');
    Route::get('roles/edit/{id}', [RoleController::class, 'edit'])->name('roles.edit');
    Route::put('roles/update/{id}', [RoleController::class, 'update'])->name('roles.update');
    Route::delete('roles/delete/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');
});
Route::get('/signin', [AuthController::class, 'signinPage'])->name('signinpage');
Route::post('/signin', [AuthController::class, 'signin'])->name('signin');
Route::get('test', function () {
    $invoice_id = $this->invoiceModel::latest()->first()->id;
    $user = User::first();
    Notification::send($user, new AddedInvoice($invoice_id));
    return 'done';
});
