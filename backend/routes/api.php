<?php

use Illuminate\Support\Facades\Route;
use App\Application\Controllers\Controller as BaseController;
use App\Domain\Task\Category\Controllers\CategoryController;
use App\Domain\Task\Status\Controllers\StatusController;
use App\Domain\Task\Task\Controllers\TaskController;

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

Route::name('TaskManager.')->group(function () {
    Route::get('status', [BaseController::class, 'healthCheck']);

    Route::prefix('task/')->group(function (){
        Route::post('create', [TaskController::class, 'create'])->name('taskCreate');
        Route::get('read/{idTask}', [TaskController::class, 'read'])->name('taskRead');
        Route::put('update', [TaskController::class, 'update'])->name('taskUpdate');
        Route::delete('delete/{idTask}', [TaskController::class, 'delete'])->name('taskDelete');
        Route::get('read-all', [TaskController::class, 'readAll'])->name('readAllTasks');
    });

    Route::prefix('status/')->group(function (){
        Route::post('create', [StatusController::class, 'create'])->name('statusCreate');
        Route::get('read/{idTask}', [StatusController::class, 'read'])->name('statusRead');
        Route::put('update', [StatusController::class, 'update'])->name('statusUpdate');
        Route::delete('delete/{idTask}', [StatusController::class, 'delete'])->name('statusDelete');
    });
});
