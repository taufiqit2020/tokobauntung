<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\POSController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\ITController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Root redirect
Route::get('/', function () {
    if (Auth::check()) {
        $user = Auth::user();
        if ($user->role === 'admin_kasir') {
            return redirect()->route('pos.index');
        } elseif ($user->role === 'keuangan') {
            return redirect()->route('keuangan.dashboard');
        } elseif ($user->role === 'admin_it') {
            return redirect()->route('it.dashboard');
        }
    }
    return redirect()->route('login');
});

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Authenticated Routes Group
Route::middleware(['auth'])->group(function () {

    // 1. Admin Kasir (POS) Routes
    Route::middleware(['role:admin_kasir'])->prefix('pos')->name('pos.')->group(function () {
        Route::get('/', [POSController::class, 'index'])->name('index');
        Route::post('/shift/open', [POSController::class, 'openShift'])->name('shift.open');
        Route::post('/shift/close', [POSController::class, 'closeShift'])->name('shift.close');
        Route::post('/transaction', [POSController::class, 'storeTransaction'])->name('transaction.store');
        Route::post('/transaction/sync', [POSController::class, 'syncOfflineTransactions'])->name('transaction.sync');
        Route::get('/products/sync-data', [POSController::class, 'getSyncData'])->name('products.sync_data');
    });

    // 2. Administrasi Keuangan Routes
    Route::middleware(['role:keuangan'])->prefix('keuangan')->name('keuangan.')->group(function () {
        Route::get('/', [KeuanganController::class, 'dashboard'])->name('dashboard');
        
        // Products CRUD
        Route::get('/products', [KeuanganController::class, 'products'])->name('products');
        Route::get('/products/next-code', [KeuanganController::class, 'getNextProductCode'])->name('products.next_code');
        Route::get('/products/export', [KeuanganController::class, 'exportProducts'])->name('products.export');
        Route::get('/products/template', [KeuanganController::class, 'downloadTemplateProducts'])->name('products.template');
        Route::post('/products/import', [KeuanganController::class, 'importProducts'])->name('products.import');
        Route::post('/products', [KeuanganController::class, 'storeProduct'])->name('products.store');
        Route::post('/products/{id}/update', [KeuanganController::class, 'updateProduct'])->name('products.update');
        Route::post('/products/{id}/delete', [KeuanganController::class, 'deleteProduct'])->name('products.delete');
        
        // Categories CRUD
        Route::get('/categories', [KeuanganController::class, 'categories'])->name('categories');
        Route::post('/categories', [KeuanganController::class, 'storeCategory'])->name('categories.store');
        Route::post('/categories/{id}/update', [KeuanganController::class, 'updateCategory'])->name('categories.update');
        Route::post('/categories/{id}/delete', [KeuanganController::class, 'deleteCategory'])->name('categories.delete');
        
        // Stock Opname
        Route::get('/stock-opname', [KeuanganController::class, 'stockOpname'])->name('stock_opname');
        Route::post('/stock-opname', [KeuanganController::class, 'storeStockOpname'])->name('stock_opname.store');
        
        // Expenses CRUD
        Route::get('/expenses', [KeuanganController::class, 'expenses'])->name('expenses');
        Route::post('/expenses', [KeuanganController::class, 'storeExpense'])->name('expenses.store');

        // ES TEGUK Incomes CRUD
        Route::get('/es-teguk', [KeuanganController::class, 'esTegukIncomes'])->name('es_teguk');
        Route::post('/es-teguk', [KeuanganController::class, 'storeEsTegukIncome'])->name('es_teguk.store');
        
        // Financial Reports
        Route::get('/reports', [KeuanganController::class, 'reports'])->name('reports');
        Route::get('/reports/{id}/print', [KeuanganController::class, 'printReceipt'])->name('reports.print');

        // Cashier Transactions List & Details
        Route::get('/transactions', [KeuanganController::class, 'transactions'])->name('transactions');
        Route::get('/transactions/{id}/details', [KeuanganController::class, 'getTransactionDetails'])->name('transactions.details');
        Route::get('/transactions/{id}/print-thermal', [KeuanganController::class, 'printThermalReceipt'])->name('transactions.print_thermal');
    });

    // 3. Admin IT Routes
    Route::middleware(['role:admin_it'])->prefix('it')->name('it.')->group(function () {
        Route::get('/', [ITController::class, 'dashboard'])->name('dashboard');
        
        // User Management
        Route::get('/users', [ITController::class, 'users'])->name('users');
        Route::post('/users', [ITController::class, 'storeUser'])->name('users.store');
        Route::post('/users/{id}/update', [ITController::class, 'updateUser'])->name('users.update');
        Route::post('/users/{id}/toggle', [ITController::class, 'toggleUser'])->name('users.toggle');
        
        // Settings
        Route::get('/settings', [ITController::class, 'settings'])->name('settings');
        Route::post('/settings', [ITController::class, 'saveSettings'])->name('settings.save');

        // Backup & Restore
        Route::get('/backup', [ITController::class, 'backup'])->name('backup');
        Route::post('/restore', [ITController::class, 'restore'])->name('restore');
    });

});

// Rute Sementara untuk Force Update Stok ke 100
Route::get('/force-update-stock', function () {
    try {
        \App\Models\Product::query()->update(['stock' => 100]);
        return 'Sukses: Semua stok barang telah berhasil diubah menjadi 100!';
    } catch (\Exception $e) {
        return 'Eror: ' . $e->getMessage();
    }
});


