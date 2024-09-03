<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->middleware('auth');

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'authenticate'])->name('authenticate');
Route::get('logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware('auth')->name('dashboard');


Route::get('kategori',[CategoryController::class, 'index'])->name('kategori');
Route::post('/kategori',[CategoryController::class, 'store'])->name('kategori.store');
Route::delete('/kategori/{id}',[CategoryController::class, 'destroy'])->name('kategori.destroy');
Route::put('/kategori/{id}',[CategoryController::class, 'update'])->name('kategori.update');
