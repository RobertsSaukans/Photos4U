<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CommentController;


Route::get('/', [CategoryController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Category routes
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/search', [CategoryController::class, 'search'])->name('categories.search');

// Photo routes
Route::get('/photos', [PhotoController::class, 'index'])->name('photos.index');
Route::get('/photos/search', [PhotoController::class, 'search'])->name('photos.search');
Route::get('/photos/create', [PhotoController::class, 'create'])->middleware('auth')->name('photos.create');
Route::post('/photos', [PhotoController::class, 'store'])->middleware('auth')->name('photos.store');
Route::get('/photos/{photo}', [PhotoController::class, 'show'])->name('photos.show');

// Comment routes
Route::post('/comments', [CommentController::class, 'store'])->middleware('auth')->name('comments.store');

// Admin routes (only accessible to authenticated users)
Route::middleware('auth')->group(function () {
    Route::get('/admin/categories/create', [AdminController::class, 'createCategory'])->name('admin.categories.create');
    Route::post('/admin/categories', [AdminController::class, 'storeCategory'])->name('admin.categories.store');
    Route::get('/admin/photos/add-category', [AdminController::class, 'addCategoryToPhoto'])->name('admin.photos.add_category');
    Route::post('/admin/photos/add-category', [AdminController::class, 'storeCategoryToPhoto']);
    Route::delete('/admin/photos/{photo}', [AdminController::class, 'deletePhoto'])->name('admin.photos.delete');
});

require __DIR__.'/auth.php';
