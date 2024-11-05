<?php

use App\Http\Controllers\LearningController;
use App\Http\Controllers\LinuxCommandController;
use Illuminate\Support\Facades\Route;


//Route::get('/', [LinuxCommandController::class, 'index'])->name('commands.index');
//Route::get('/search', [LinuxCommandController::class, 'search'])->name('commands.search');
Route::get('/', [LearningController::class, 'index'])->name('home');

Route::prefix('commands')->group(function () {
    Route::get('/', [LinuxCommandController::class, 'index'])->name('commands.index');
    Route::get('/create', [LinuxCommandController::class, 'create'])->name('commands.create');
    Route::post('/', [LinuxCommandController::class, 'store'])->name('commands.store');
    Route::get('/{command}/edit', [LinuxCommandController::class, 'edit'])->name('commands.edit');
    Route::put('/{command}', [LinuxCommandController::class, 'update'])->name('commands.update');
    Route::delete('/{command}', [LinuxCommandController::class, 'destroy'])->name('commands.destroy');
    Route::get('/search', [LinuxCommandController::class, 'search'])->name('commands.search');
});
