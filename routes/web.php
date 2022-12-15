<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {return view('welcome');})->name('welcome');

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginSubmit'])->name('login.submit');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/register', [AuthController::class, 'registerSubmit'])->name('register.submit');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::group([
    'prefix' => '/category',
    'as' => 'category.',
    'middleware' => 'auth',
], function () {
    Route::get('/list', [CategoryController::class, 'index'])->name('index');
    Route::get('/show/{category}', [CategoryController::class, 'show'])->name('show');
    Route::post('/store', [CategoryController::class, 'store'])->name('store');
    Route::put('/{category}', [CategoryController::class, 'update'])->name('update');
    Route::delete('/{category}', [CategoryController::class, 'delete'])->name('delete');
});

Route::group([
    'as' => 'task.',
], function () {
    Route::post('/category{category}/store', [TaskController::class, 'store'])->name('store');
    Route::get('/task/{task}/edit', [TaskController::class, 'edit'])->name('edit');
    Route::put('/task/{task}/update', [TaskController::class, 'update'])->name('update');
    Route::put('/task/{task}/finish', [TaskController::class, 'finish'])->name('finish');
    Route::delete('/task/{task}/delete', [TaskController::class, 'delete'])->name('delete');
});
