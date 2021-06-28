<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\auth\{LoginController,LogoutController,RegisterController};
use App\Http\Controllers\{BookController, BorrowController, UserController,DashboardController};

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/login', [LoginController::class, 'login'])->name('auth.login');
Route::post('/login', [LoginController::class, 'store']);
Route::get('/register', [RegisterController::class, 'register'])->name('auth.register');
Route::post('/register', [RegisterController::class, 'store']);
Route::post('/logout', [LogoutController::class, 'store' ])->name('auth.logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('perpusku')->name('perpusku.')->group(function () {
        Route::get('/book', [BookController::class, 'index'])->name('book.index');
        Route::get('/book', [BookController::class, 'index'])->name('book.index');
        Route::post('/book/create', [BookController::class, 'store'])->name('book.store');
        Route::get('/book/{id}', [BookController::class, 'edit'])->name('book.edit');
        Route::patch('/book/{id}', [BookController::class, 'update']);
        Route::delete('/book/{id}', [BookController::class, 'destroy'])->name('book.destroy');

        Route::get('/borrow', [BorrowController::class, 'index'])->name('borrow.index');
        Route::post('/borrow', [BorrowController::class, 'store']);
        Route::patch('/borrow/konfirmasi/{id}', [BorrowController::class, 'konfirmasi'])->name('borrow.konfirmasi');
        Route::patch('/borrow/kembali/{id}', [BorrowController::class, 'kembali'])->name('borrow.kembali');
        Route::patch('/borrow/denda/{id}', [BorrowController::class, 'denda'])->name('borrow.denda');
        Route::delete('/borrow/delete/{id}', [BorrowController::class, 'destroy'])->name('borrow.destroy');
        Route::get('/borrow/print', [BorrowController::class, 'print'])->name('borrow.print');

        Route::get('/profil', [UserController::class, 'index'])->name('profil.index');
        Route::post('/profil/bayar/{id}', [UserController::class, 'bayar'])->name('profil.bayar');
        Route::patch('/profil/{id}', [UserController::class, 'update'])->name('profil.update');
    });
});

// Route::get('test',fn () => view('layouts.app'));
