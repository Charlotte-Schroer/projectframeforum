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

// Dashboard (authenticated users)
// Dashboard (authenticated users)
Route::get('/dashboard', function () {
    if (auth()->user()->is_admin) {
        return redirect()->route('admin.dashboard');
    }
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Public routes
Route::get('/news', [NewsController::class, 'index'])->name('news.index');
Route::get('/news/{news}', [NewsController::class, 'show'])->name('news.show');
Route::get('/faq', [FaqItemController::class, 'index'])->name('faq.index');
Route::get('/contact', [ContactMessageController::class, 'create'])->name('contact.create');
Route::post('/contact', [ContactMessageController::class, 'store'])->name('contact.store');

// Public profiles
Route::get('/profiles', [ProfileController::class, 'index'])->name('profile.index');
Route::get('/profile/{username}', [ProfileController::class, 'show'])->name('profile.show');

// Forum - public
Route::get('/forum', [TopicController::class, 'index'])->name('forum.index');
Route::get('/forum/{topic}', [TopicController::class, 'show'])->name('forum.show');

// Authenticated routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Forum - authenticated
    Route::get('/forum/create', [TopicController::class, 'create'])->name('forum.create');
    Route::post('/forum', [TopicController::class, 'store'])->name('forum.store');
    Route::post('/forum/{topic}/posts', [PostController::class, 'store'])->name('posts.store');
});

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    //Admin Dashboard
    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('dashboard');

    //Admin Management
    Route::get('/news', [NewsController::class, 'adminIndex'])->name('news.index');
    Route::get('/news/create', [NewsController::class, 'create'])->name('news.create');
    Route::post('/news', [NewsController::class, 'store'])->name('news.store');
    Route::get('/news/{news}/edit', [NewsController::class, 'edit'])->name('news.edit');
    Route::patch('/news/{news}', [NewsController::class, 'update'])->name('news.update');
    Route::delete('/news/{news}', [NewsController::class, 'destroy'])->name('news.destroy');

    Route::resource('faq-categories', FaqCategoryController::class)->except(['show']);
    Route::resource('faq-items', FaqItemController::class)->except(['show']);

    Route::get('/contact-messages', [ContactMessageController::class, 'index'])->name('contact.index');
    Route::get('/contact-messages/{contactMessage}', [ContactMessageController::class, 'show'])->name('contact.show');
    Route::delete('/contact-messages/{contactMessage}', [ContactMessageController::class, 'destroy'])->name('contact.destroy');
});

require __DIR__ . '/auth.php';
