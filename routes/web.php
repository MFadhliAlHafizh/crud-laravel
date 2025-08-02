<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BukuController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [BukuController::class, 'index'])->name('buku.index');

Route::post('/', [BukuController::class, 'store'])->name('buku.store');

Route::get('/{id}/edit', [BukuController::class, 'edit'])->name('buku.edit');

Route::put('/{id}/update', [BukuController::class, 'update'])->name('buku.update');

Route::delete('/{id}/delete', [BukuController::class, 'destroy'])->name('buku.delete');

Route::delete('/deleteAll', [BukuController::class, 'destroyAll'])->name('buku.deleteAll');
