<?php

use App\Http\Controllers\CashierController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', [
        DashboardController::class,
        'index'
    ])->middleware('verified')->name('dashboard');

    Route::resource('categories', CategoryController::class);
    Route::resource('products', ProductController::class);

    Route::get('/cashier', [CashierController::class, 'index'])
        ->name('cashier.index');

    Route::post('/cashier/add/{id}', [CashierController::class, 'add'])
        ->name('cashier.add');

    Route::delete('/cashier/remove/{id}', [CashierController::class, 'remove'])
        ->name('cashier.remove');

    Route::delete('/cashier/clear', [CashierController::class, 'clear'])
        ->name('cashier.clear');

    Route::post('/cashier/checkout', [CashierController::class, 'store'])
        ->name('cashier.store');

    Route::get('/transactions', [
        TransactionController::class,
        'index'
    ])->name('transactions.index');

    Route::get('/transactions/{id}', [
        TransactionController::class,
        'show'
    ])->name('transactions.show');
});

require __DIR__.'/auth.php';
