<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/home', [AdminController::class, 'index'])->name('home');
    Route::get('/list-obat', function () {
        return view('obat.index');
    })->name('list-obat');
});

// Route::middleware(['auth-sanctum', config('jetstream.auth_session'), 'verified'])->get('/list-obat', function () {
//     return view('obat.index');
// })->name('list-obat');

Route::get('/test', function () {
    return view('testing');
})->name('testing');
