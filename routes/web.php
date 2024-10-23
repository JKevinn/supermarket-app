<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
})->name('index');

Route::prefix('/product')->name('product.')->group(function () {
    Route::get('/create', [ProductController::class, 'create'])->name('create');
    Route::post('/store', [ProductController::class, 'store'])->name('store');
    Route::get('/index', [ProductController::class, 'index'])->name('index');
    Route::get('/edit/{id}', [ProductController::class, 'edit'])->name('edit');
    Route::delete('/delete/{id}', [ProductController::class, 'destroy'])->name('delete');
    Route::patch('/update/{id}', [ProductController::class, 'update'])->name('update');
    Route::patch('/updateStock/{id}', [ProductController::class, 'updateStock'])->name('updateStock');
});

Route::prefix('/user')->name('user.')->group(function () {
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/store', [UserController::class, 'store'])->name('store');
    Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('delete');
    Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
    Route::patch('/update/{id}', [UserController::class, 'update'])->name('update');
});
