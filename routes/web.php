<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [\App\Http\Controllers\QueryController::class, 'store']);
Route::get('/blog', [PageController::class, 'blog'])->name('blog');
Route::get('/blog/{id}', [PageController::class, 'showBlog'])->name('blog.show');

Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::get('/file/download/{id}', [\App\Http\Controllers\FileController::class, 'download'])
    ->middleware(['auth'])
    ->name('file.download');

Route::post('/file/upload', [\App\Http\Controllers\FileController::class, 'storeClientFile'])
    ->middleware(['auth'])
    ->name('file.upload');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [\App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');
    Route::post('/announcement', [\App\Http\Controllers\AdminController::class, 'postAnnouncement'])->name('announcement');
    Route::get('/users', [\App\Http\Controllers\AdminController::class, 'users'])->name('users');
    Route::get('/users/{id}', [\App\Http\Controllers\AdminController::class, 'showUser'])->name('users.show');
    Route::post('/users/{id}/appointment', [\App\Http\Controllers\AdminController::class, 'scheduleAppointment'])->name('users.appointment');
    Route::post('/users/{id}/update', [\App\Http\Controllers\AdminController::class, 'updateUser'])->name('users.update');
    Route::delete('/users/{id}', [\App\Http\Controllers\AdminController::class, 'deleteUser'])->name('users.delete');
    Route::get('/queries', [\App\Http\Controllers\AdminController::class, 'queries'])->name('queries');
    Route::post('/queries/{id}/reply', [\App\Http\Controllers\AdminController::class, 'replyQuery'])->name('queries.reply');
    Route::delete('/queries/{id}', [\App\Http\Controllers\AdminController::class, 'deleteQuery'])->name('queries.delete');
    Route::get('/blogs', [\App\Http\Controllers\AdminController::class, 'blogs'])->name('blogs');
    Route::post('/blogs', [\App\Http\Controllers\AdminController::class, 'storeBlog'])->name('blogs.store');
    Route::post('/blogs/{id}/update', [\App\Http\Controllers\AdminController::class, 'updateBlog'])->name('blogs.update');
    Route::delete('/blogs/{id}', [\App\Http\Controllers\AdminController::class, 'deleteBlog'])->name('blogs.delete');
    Route::get('/files', [\App\Http\Controllers\AdminController::class, 'files'])->name('files');
    Route::post('/files', [\App\Http\Controllers\AdminController::class, 'storeFile'])->name('files.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
