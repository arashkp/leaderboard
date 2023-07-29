<?php

use App\Http\Controllers\UserController;
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

Route::get('/', [UserController::class, 'index'])->name('index');
Route::get('/api/users', [UserController::class, 'users'])->name('users');
Route::post('/api/user', [UserController::class, 'store'])->name('store');
Route::put('/api/update', [UserController::class, 'update'])->name('update');
Route::delete('/api/delete/{user}', [UserController::class, 'delete'])->name('delete');
