<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StockInController;
use App\Http\Controllers\StockOutController;
use App\Http\Controllers\ReportController;
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
Route::redirect('/', '/dashboard');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('/login', [AuthenticatedSessionController::class, 'store'])->name('login.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])
    ->name('dashboard');

    Route::middleware('role:admin')->group(function () {
        Route::resource('categories', CategoryController::class)
            ->except('show');
        
        Route::resource('suppliers', SupplierController::class)
            ->except('show');
        
        Route::resource('products', ProductController::class)
            ->except('show');

        Route::resource('users', UserController::class)
            ->except('show');

        Route::resource('stock-ins', StockInController::class)
            ->except('show');
        
        Route::resource('stock-outs', StockOutController::class)
            ->except('show');
        
        Route::get('/reports/stock-in', [ReportController::class, 'stockIn'])
            ->name('reports.stock-in');
        Route::get(
            '/reports/stock-in/export-excel',
            [ReportController::class, 'exportStockInExcel']
        )->name('reports.stock-in.excel');
        Route::get(
            '/reports/stock-in/export-pdf',
            [ReportController::class, 'exportStockInPdf']
        )->name('reports.stock-in.pdf');

        Route::get('/reports/stock-out', [ReportController::class, 'stockOut'])
            ->name('reports.stock-out');
        Route::get(
            '/reports/stock-out/export-excel',
            [ReportController::class, 'exportStockOutExcel']
        )->name('reports.stock-out.excel');

        Route::get(
            '/reports/stock-out/export-pdf',
            [ReportController::class, 'exportStockOutPdf']
        )->name('reports.stock-out.pdf');

        Route::get('/reports/inventory', [ReportController::class, 'inventory'])
            ->name('reports.inventory');
        Route::get(
            '/reports/inventory/export-excel',
            [ReportController::class, 'exportInventoryExcel']
        )->name('reports.inventory.excel');
        Route::get(
            '/reports/inventory/export-pdf',
            [ReportController::class, 'exportInventoryPdf']
        )->name('reports.inventory.pdf');
    });

    Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
});
