<?php

use App\Mail\SendEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SendEmailController;
use App\Http\Controllers\Auth\GoogleController;
use App\Http\Controllers\BookCategoryController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;


Route::get('/', function () {
    return view('welcome');
});
        
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('guest')->group(function () {
    Route::get('forgot-password-new', [PasswordResetLinkController::class, 'create'])->name('password-new.request');
    Route::post('forgot-password-new', [PasswordResetLinkController::class, 'store'])->name('password-new.email');
    Route::get('reset-password-new/{token}', [NewPasswordController::class, 'create'])->name('password-new.reset');
    Route::put('reset-password-new', [NewPasswordController::class, 'store'])->name('password-new.update');
});

Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('book-categories')->group(function () {
        Route::get('/', [BookCategoryController::class, 'index'])->name('book_categories.index');
        Route::get('create', [BookCategoryController::class, 'create'])->name('book_categories.create');
        Route::post('store', [BookCategoryController::class, 'store'])->name('book_categories.store');
        Route::get('edit/{id}', [BookCategoryController::class, 'edit'])->name('book_categories.edit');
        Route::put('update/{id}', [BookCategoryController::class, 'update'])->name('book_categories.update'); // Ganti POST ke PUT
        Route::delete('destroy/{id}', [BookCategoryController::class, 'destroy'])->name('book_categories.destroy');
    });
    
    Route::prefix('books')->group(function () {
        Route::get('/', [BookController::class, 'index'])->name('books.index');
        Route::get('/books/export', [BookController::class, 'export'])->name('books.export');
        Route::post('/books/import', [BookController::class, 'import'])->name('books.import');
        Route::get('create', [BookController::class, 'create'])->name('books.create');
        Route::post('store', [BookController::class, 'store'])->name('books.store');
        Route::get('/books/{id}', [BookController::class, 'show'])->name('books.show');
        Route::get('edit/{id}', [BookController::class, 'edit'])->name('books.edit');
        Route::put('update/{id}', [BookController::class, 'update'])->name('books.update'); // Hanya PUT
        Route::delete('destroy/{id}', [BookController::class, 'destroy'])->name('books.destroy');
    });    
    
    Route::get('/kirim-email', [SendEmailController::class, 'index'])->name('kirim-email');

    Route::post('/post-email', [SendEmailController::class, 'store'])->name('post-email');

    Route::get('/send',function(){
        $data = [
            'name' => 'Vincent Rahadian Utama',
            'body' => 'Testing Kirim Email'
        ];
        
        Mail    ::to('vincentutama38@smk.belajar.id')->send(new SendEmail($data));
        
        dd("Email Berhasil dikirim.");
    });

});

require __DIR__.'/auth.php';



