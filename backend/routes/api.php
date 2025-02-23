<?php

use Illuminate\Support\Facades\Route;
use App\Application\Controllers\Controller as BaseController;
use App\Domain\Expense\Controllers\ExpenseController;
use App\Domain\Income\Controllers\IncomeController;
use App\Domain\Person\Controllers\PersonController;

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

Route::name('MyFinanceiro.')->group(function () {
    Route::get('status', [BaseController::class, 'healthCheck']);

    Route::prefix('person/')->group(function (){
        Route::post('create', [PersonController::class, 'create'])->name('personCreate');
        Route::get('read/{id?}/{mounth?}', [PersonController::class, 'read'])->name('personRead');
    });

    Route::prefix('income/')->group(function (){
        Route::post('create', [IncomeController::class, 'create'])->name('incomeCreate');
    });

    Route::prefix('expense/')->group(function (){
        Route::post('create', [ExpenseController::class, 'create'])->name('expenseCreate');
    });
});
