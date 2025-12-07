<?php

declare(strict_types=1);

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\FaqItemController;
use App\Http\Controllers\FaqCategoryController;
use App\Http\Controllers\ContactMessageController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Public routes
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{news}', [NewsController::class, 'show'])->name('news.show');
Route::get('/faq', [FaqItemController::class, 'index'])->name('faq.index');
Route::get('/contact', [ContactMessageController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactMessageController::class, 'store'])->name('contact.store');

// Public profiles
Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');

// Forum - public
Route::get('/forum', [TopicController::class, 'index'])->name('forum.index');
Route::get('/forum/{topic}', [TopicController::class, 'show'])->name('forum.show');

// Authenticated routes
Route::middleware('auth')->group(function () {
Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

// Forum - authenticated
Route::post('/forum', [TopicController::class, 'store'])->name('forum.store');
Route::post('/forum/{topic}/posts', [PostController::class, 'store'])->name('posts.store');
});

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
Route::resource('news', NewsController::class)->except(['index', 'show']);
Route::resource('faq-categories', FaqCategoryController::class);
Route::resource('faq-items', FaqItemController::class);
});

require __DIR__.'/auth.php';
