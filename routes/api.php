<?php
  


use App\Http\Controllers\Api\Assets\AssetController;
use App\Http\Controllers\Api\Expenses\ExpenseController;
use App\Http\Controllers\Api\History\HistoryController;
use App\Http\Controllers\Api\Income\IncomeController;
use App\Http\Controllers\Api\Monthly_Reports\MonthlyReportController;
use App\Http\Controllers\Api\Package\PackageController;
use App\Http\Controllers\Api\Payments\PaymentController;
use App\Http\Controllers\Api\Reservations\ReservationController;
use App\Http\Controllers\Api\User\UserController;
use App\Http\Controllers\Auth\AuthenticationController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

//semua data transaksi
Route::apiResource('/all_transaksi', App\Http\Controllers\Api\Transaction\TransaksiController::class);
//semua data transaksi
//semua payment method
Route::apiResource('/payment_method', App\Http\Controllers\Api\PaymentMethodController::class);
//semua payment jenis transaksi
Route::apiResource('/type_transaksi', App\Http\Controllers\Api\Type_TransaksiController::class);
//semua event
Route::apiResource('/event', App\Http\Controllers\Api\EventController::class);

Route::middleware('auth:sanctum')->get('/user',function (Request $requset){
    return $requset->user();
});
Route::get('/test',function () {
    return response([
        'massage' => 'Api is working'
    ], 200);
});

Route::post('/register', [AuthenticationController::class, 'register']);
Route::post('/login', [AuthenticationController::class, 'login']);
Route::post('/logout', [AuthenticationController::class, 'logout'])->middleware('auth:sanctum');

Route::prefix('users')->group(function () {
    Route::get('/', [UserController::class, 'index']);
    Route::post('/', [UserController::class, 'store']);
    Route::get('/{id}', [UserController::class, 'show']);
    Route::put('/{id}', [UserController::class, 'update']);
    Route::delete('/{id}', [UserController::class, 'destroy']);
});

Route::prefix('reservations')->group(function () {
    Route::get('/', [ReservationController::class, 'index']);
    Route::get('/latest', [ReservationController::class, 'latestByUser']);
    Route::get('/upcoming', [ReservationController::class, 'upcoming']);
    Route::post('/', [ReservationController::class, 'store']);
    Route::get('/{id}', [ReservationController::class, 'show']);
    Route::get('/', [ReservationController::class, 'getByDate']);
    Route::put('/{id}', [ReservationController::class, 'update']);
    Route::delete('/{id}', [ReservationController::class, 'destroy']);
});

Route::prefix('payments')->group(function () {
    Route::get('/', [PaymentController::class, 'index']);
    Route::post('/', [PaymentController::class, 'store']);
    Route::get('/{id}', [PaymentController::class, 'show']);
    Route::put('/{id}', [PaymentController::class, 'update']);
    Route::delete('/{id}', [PaymentController::class, 'destroy']);
});

Route::prefix('packages')->group(function () {
    Route::get('/', [PackageController::class, 'index']);
    Route::post('/', [PackageController::class, 'store']);
    Route::get('/{id}', [PackageController::class, 'show']);
    Route::put('/{id}', [PackageController::class, 'update']);
    Route::delete('/{id}', [PackageController::class, 'destroy']);
});

Route::prefix('monthly-reports')->group(function () {
    Route::get('/', [MonthlyReportController::class, 'index']);
    Route::post('/', [MonthlyReportController::class, 'store']);
    Route::get('/{id}', [MonthlyReportController::class, 'show']);
    Route::put('/{id}', [MonthlyReportController::class, 'update']);
    Route::delete('/{id}', [MonthlyReportController::class, 'destroy']);
});

Route::prefix('incomes')->group(function () {
    Route::get('/', [IncomeController::class, 'index']);
    Route::post('/', [IncomeController::class, 'store']);
    Route::get('/{id}', [IncomeController::class, 'show']);
    Route::put('/{id}', [IncomeController::class, 'update']);
    Route::delete('/{id}', [IncomeController::class, 'destroy']);
});

Route::prefix('histories')->group(function () {
    Route::get('/', [HistoryController::class, 'index']);
    Route::get('/', [HistoryController::class, 'getHistoriesByUserId']);
    Route::post('/', [HistoryController::class, 'store']);
    Route::get('/{id}', [HistoryController::class, 'show']);
    Route::put('/{id}', [HistoryController::class, 'update']);
    Route::delete('/{id}', [HistoryController::class, 'destroy']);
});

Route::prefix('expenses')->group(function () {
    Route::get('/', [ExpenseController::class, 'index']);
    Route::post('/', [ExpenseController::class, 'store']);
    Route::get('/{id}', [ExpenseController::class, 'show']);
    Route::put('/{id}', [ExpenseController::class, 'update']);
    Route::delete('/{id}', [ExpenseController::class, 'destroy']);
});

Route::prefix('assets')->group(function () {
    Route::get('/', [AssetController::class, 'index']);
    Route::post('/', [AssetController::class, 'store']);
    Route::get('/{id}', [AssetController::class, 'show']);
    Route::put('/{id}', [AssetController::class, 'update']);
    Route::delete('/{id}', [AssetController::class, 'destroy']);
});
