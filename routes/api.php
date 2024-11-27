<?php

use App\Http\Controllers\API\EmployeeController;
use App\Http\Controllers\API\SalesDataController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('employees')->group(function () {
    Route::get('/', [EmployeeController::class, 'index']);
    Route::get('/{employee_id}', [EmployeeController::class, 'show']);
    Route::post('/', [EmployeeController::class, 'store']);
    Route::put('/{employee_id}', [EmployeeController::class, 'update']);
    Route::delete('/{employee_id}', [EmployeeController::class, 'destroy']);
});

Route::prefix('sales')->group(function () {
    Route::get('/', [SalesData::class, 'index']);
    Route::get('/{sales_id}', [SalesData::class, 'show']);
    Route::post('/', [SalesData::class, 'store']);
    Route::put('/{sales_id}', [SalesData::class, 'update']);
    Route::delete('/{sales_id}', [SalesData::class, 'destroy']);
});
