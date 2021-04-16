<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StatusController;
use App\Http\Controllers\TaskController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::group(['prefix' => 'statuses'], function () {
    Route::get('', [StatusController::class, 'index'])->name('status.index');
    Route::get('create', [StatusController::class, 'create'])->name('status.create');
    Route::post('store', [StatusController::class, 'store'])->name('status.store');
    Route::get('edit/{status}', [StatusController::class, 'edit'])->name('status.edit');
    Route::post('update/{status}', [StatusController::class, 'update'])->name('status.update');
    Route::post('delete/{status}', [StatusController::class, 'destroy'])->name('status.destroy');
    Route::get('show/{status}', [StatusController::class, 'show'])->name('status.show');
});
Route::group(['prefix' => 'tasks'], function () {
    Route::get('', [TaskController::class, 'index'])->name('task.index');
    Route::get('create', [TaskController::class, 'create'])->name('task.create');
    Route::post('store', [TaskController::class, 'store'])->name('task.store');
    Route::get('edit/{task}', [TaskController::class, 'edit'])->name('task.edit');
    Route::post('update/{task}', [TaskController::class, 'update'])->name('task.update');
    Route::post('delete/{task}', [TaskController::class, 'destroy'])->name('task.destroy');
    Route::get('show/{task}', [TaskController::class, 'show'])->name('task.show');
    Route::get('pdf/{task}', [TaskController::class, 'pdf'])->name('task.pdf');
});