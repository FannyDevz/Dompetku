<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ExcelImportController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WalletController;
use Illuminate\Support\Facades\Route;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store'])->name('register.post');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.post');
Route::any('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'auth.session'])->group(function () {
    Route::get('/wallet', [WalletController::class, 'index'])->name('wallet.index');
    Route::get('/wallet/{wallet}/transactions', [WalletController::class, 'transactions'])
        ->name('wallet.transactions');
    Route::get('/wallet/create', [WalletController::class, 'create'])->name('wallet.create');
    Route::get('/wallet/{id}/edit', [WalletController::class, 'edit'])->name('wallet.edit');
    Route::post('/wallet/{id}', [WalletController::class, 'update'])->name('wallet.update');
    Route::delete('/wallet/{id}', [WalletController::class, 'destroy'])->name('wallet.delete');
    Route::post('/wallet', [WalletController::class, 'store'])->name('wallet.store');

    Route::post('/transaction/{id}/outcome', [TransactionController::class, 'storeOutcome'])->name('transaction.store.outcome');
    Route::post('/transaction/{id}/income', [TransactionController::class, 'storeIncome'])->name('transaction.store.income');
    Route::post('/transaction/{id}', [TransactionController::class, 'update'])->name('transaction.update');
    Route::delete('/transaction/{id}', [TransactionController::class, 'destroy'])->name('transaction.delete');

    Route::get('/recycle-bin/wallet', [WalletController::class, 'recycle_index'])->name('recycle-bin.wallet.index');
    Route::get('/recycle-bin/wallet/{id}/transactions', [WalletController::class, 'recycle_transactions'])
        ->name('recycle-bin.wallet.transactions');
    Route::post('/recycle-bin/wallet/{id}/restore', [WalletController::class, 'recycle_restore'])
        ->name('recycle-bin.wallet.restore');
    Route::delete('/recycle-bin/wallet/{id}/delete', [WalletController::class, 'recycle_delete'])
        ->name('recycle-bin.wallet.delete');


    Route::get('/income/category', [CategoryController::class, 'incomeIndex'])->name('income.category.index');
    Route::post('/income/category', [CategoryController::class, 'incomeStore'])->name('income.category.store');
    Route::post('/income/category/{id}', [CategoryController::class, 'incomeUpdate'])->name('income.category.update');
    Route::delete('/income/category/{id}', [CategoryController::class, 'incomeDelete'])->name('income.category.destroy');

    Route::get('/outcome/category', [CategoryController::class, 'outcomeIndex'])->name('outcome.category.index');
    Route::post('/outcome/category', [CategoryController::class, 'outcomeStore'])->name('outcome.category.store');
    Route::post('/outcome/category/{id}', [CategoryController::class, 'outcomeUpdate'])->name('outcome.category.update');
    Route::delete('/outcome/category/{id}', [CategoryController::class, 'outcomeDelete'])->name('outcome.category.destroy');

    Route::get('/import-excel', [ExcelImportController::class, 'showImportForm'])->name('import-excel');
    Route::post('/import-excel', [ExcelImportController::class, 'import'])->name('import-excel');
    Route::post('/process-import', [ExcelImportController::class, 'processImport'])->name('process-import');
    Route::get('/export-excel', [ExcelImportController::class, 'export'])->name('export-excel');

    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('/profile', [UserController::class, 'profile'])->name('profile.index');
    Route::post('/profile', [UserController::class, 'update'])->name('profile.update');
});
