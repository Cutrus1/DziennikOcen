<?php

use App\Http\Controllers\OgolneController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SubjectController;
use Illuminate\Support\Facades\Route;

// Strony ogólne
Route::get('/', [OgolneController::class, 'start'])->name('start');
Route::get('/onas', [OgolneController::class, 'onas'])->name('onas');
Route::get('/kontakt', [OgolneController::class, 'kontakt'])->name('kontakt');

// Middleware dla uwierzytelnionych użytkowników
Route::middleware(['auth'])->group(function () {
    // Trasa dostępna dla wszystkich zalogowanych użytkowników
    Route::get('/grades', [GradeController::class, 'index'])->name('grades.index');

    // Trasy dla nauczycieli i administratorów
    Route::middleware(['role:teacher,admin'])->group(function () {
        Route::get('/grades/create', [GradeController::class, 'create'])->name('grades.create');
        Route::post('/grades', [GradeController::class, 'store'])->name('grades.store');
        Route::get('/grades/{grade}/edit', [GradeController::class, 'edit'])->name('grades.edit');
        Route::put('/grades/{grade}', [GradeController::class, 'update'])->name('grades.update');
        Route::delete('/grades/{grade}', [GradeController::class, 'destroy'])->name('grades.destroy');
    });

    // Trasy dostępne tylko dla administratorów
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('users', AdminController::class);
        Route::resource('subjects', SubjectController::class);
    });

    // Trasy dla postów (dostępne dla zalogowanych użytkowników)
    Route::resource('post', PostController::class);

    // Powrót na stronę główną
    Route::get('/dashboard', function () {
        return redirect()->route('start');
    })->middleware(['auth', 'verified'])->name('dashboard');

    // Trasy dla profilu użytkownika
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Trasy dla uwierzytelniania
require __DIR__.'/auth.php';

Route::resource('post', PostController::class);
