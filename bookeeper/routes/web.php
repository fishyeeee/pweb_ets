<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BorrowingController;
use Illuminate\Support\Facades\Route;

// 🏠 Halaman utama
Route::get('/', [BookController::class, 'index']);

// 📊 Dashboard (hanya bisa diakses setelah login)
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// 🧑‍💼 Semua route di bawah ini hanya bisa diakses user yang sudah login
Route::middleware('auth')->group(function () {

    // Profil user (bawaan Breeze)
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // 📚 CRUD Buku
    Route::resource('books', BookController::class);

    // 🗂️ CRUD Kategori Buku
    Route::resource('categories', CategoryController::class);

    // 🔄 Peminjaman Buku
    Route::post('/borrowings/store', [BorrowingController::class, 'store'])->name('borrowings.store');
    Route::post('/borrowings/return/{id}', [BorrowingController::class, 'returnBook'])->name('borrowings.return');
});

require __DIR__.'/auth.php';
