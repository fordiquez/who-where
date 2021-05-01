<?php

use App\Http\Controllers\CountryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LeagueController;
use App\Http\Controllers\TransferController;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/home')->name('root');

Route::get('/home', [HomeController::class, 'index'])->name('home.index');

Route::get('/countries', [CountryController::class, 'index'])->name('country.index');
Route::get('/country/show/{id}', [CountryController::class, 'show'])->name('country.show');
Route::post('/country/store', [CountryController::class, 'store'])->name('country.store');
Route::get('/country/edit/{id}', [CountryController::class, 'edit'])->name('country.edit');
Route::post('/country/update/{id}', [CountryController::class, 'update'])->name('country.update');

Route::get('/leagues/{country_id?}', [LeagueController::class, 'index'])->name('league.index');
Route::get('/league/show/{id}', [LeagueController::class, 'show'])->name('league.show');

Route::get('/transfers', [TransferController::class, 'index'])->name('transfer.index');
Route::post('/transfer/store', [TransferController::class, 'store'])->name('transfer.store');
Route::get('/transfer/show/{id}', [TransferController::class, 'show'])->name('transfer.show');
Route::get('/transfer/edit/{id}', [TransferController::class, 'edit'])->name('transfer.edit');
Route::post('/transfer/update/{id}', [TransferController::class, 'update'])->name('transfer.update');
Route::get('/transfer/delete/{id}', [TransferController::class, 'delete'])->name('transfer.delete');
