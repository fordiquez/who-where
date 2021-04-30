<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\TransferController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/home')->name('root');

Route::get('/home', [HomeController::class, 'index'])->name('home.index');
Route::get('/transfers', [HomeController::class, 'players'])->name('home.players');

Route::post('/transfer/store', [TransferController::class, 'store'])->name('transfer.store');
Route::get('/transfer/show/{id}', [TransferController::class, 'show'])->name('transfer.show');
Route::get('/transfer/edit/{id}', [TransferController::class, 'edit'])->name('transfer.edit');
Route::post('/transfer/update/{id}', [TransferController::class, 'update'])->name('transfer.update');
Route::get('/transfer/delete/{id}', [TransferController::class, 'delete'])->name('transfer.delete');
