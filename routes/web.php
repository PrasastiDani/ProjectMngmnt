<?php

use App\Http\Controllers\Web\AccountingController;
use App\Http\Controllers\web\AuthController;
use App\Http\Controllers\Web\ExpenseController;
use App\Http\Controllers\Web\IncomeController;
use App\Http\Controllers\Web\InventoryController;
use App\Http\Controllers\Web\TransactionController;
use Illuminate\Routing\RouteGroup;
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


Route::group(['prefix' => '/', 'as' => 'auth.'], function () {
    Route::get('', [AuthController::class, 'index'])->name('login');
    Route::post('', [AuthController::class, 'authenticate'])->name('auth');
    Route::post('logout', [AuthController::class, 'destroy'])->name('logout');
});


Route::group(['prefix' => 'transaction/', 'as' => 'transaction.'], function () {
    Route::get('', [TransactionController::class, 'index'])->name('index');
    Route::get('create', [TransactionController::class, 'create']);
    Route::post('{reservationId}', [TransactionController::class, 'store'])->name('store');
    Route::get('{transaction}', [TransactionController::class, 'show']);
    Route::get('{transaction}/edit', [TransactionController::class, 'edit']);
    Route::put('{transaction}', [TransactionController::class, 'update']);
    Route::delete('{transaction}', [TransactionController::class, 'destroy']);
});

Route::group(['prefix' => 'accounting/', 'as' => 'accounting.'], function () {
    Route::get('', [AccountingController::class, 'index'])->name('index');
    Route::get('create', [AccountingController::class, 'create']);
    Route::post('', [AccountingController::class, 'store'])->name('store');
    Route::get('{account}', [AccountingController::class, 'show']);
    Route::get('{account}/edit', [AccountingController::class, 'edit']);
    Route::put('{account}', [AccountingController::class, 'update']);
    Route::delete('{account}', [AccountingController::class, 'destroy']);
});

Route::group(['prefix' => 'income/', 'as' => 'income.'], function () {
    Route::get('', [IncomeController::class, 'index'])->name('index');
    Route::get('create', [IncomeController::class, 'create']);
    Route::post('', [IncomeController::class, 'store'])->name('store');
    Route::get('{income}', [IncomeController::class, 'show']);
    Route::get('{income}/edit', [IncomeController::class, 'edit']);
    Route::put('{income}', [IncomeController::class, 'update']);
    Route::delete('{income}', [IncomeController::class, 'destroy']);
});

Route::group(['prefix' => 'expense/', 'as' => 'expense.'], function () {
    Route::get('', [ExpenseController::class, 'index'])->name('index');
    Route::get('create', [ExpenseController::class, 'create']);
    Route::post('', [ExpenseController::class, 'store'])->name('store');
    Route::get('{expense}', [ExpenseController::class, 'show']);
    Route::get('{expense}/edit', [ExpenseController::class, 'edit']);
    Route::put('{expense}', [ExpenseController::class, 'update']);
    Route::delete('{expense}', [ExpenseController::class, 'destroy']);
});

Route::group(['prefix' => 'inventory/', 'as' => 'inventory.'], function () {
    Route::get('', [InventoryController::class, 'index'])->name('index');
    Route::get('create', [InventoryController::class, 'create']);
    Route::post('', [InventoryController::class, 'store'])->name('store');
    Route::get('{asset}', [InventoryController::class, 'show']);
    Route::get('{asset}/edit', [InventoryController::class, 'edit']);
    Route::put('{asset}', [InventoryController::class, 'update']);
    Route::delete('destroy', [InventoryController::class, 'destroy'])->name('destroy');
});
