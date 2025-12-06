<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardPostController;
use App\Models\Category;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/blog', function () {
    return view('blog');
});

Route::get('/contact', function () {
    return view('contact');
});
    
Route::get('/categories', function () {
    return view('categories');
});

Route::get('/posts', [PostController::class, 'index'])->name('posts.index');
Route::get('/posts/{post:slug}', [PostController::class, 'show'])->name('posts.show');

Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
    
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::post('/logout', [LoginController::class, 'logout'])->middleware('auth')->name('logout');

Route::middleware(['auth'])->group(function () {
        Route::get('/dashboard', function() {
        return redirect('/dashboard/posts');
    });

     Route::resource('/dashboard/posts', DashboardPostController::class)->names([
        'index'   => 'dashboard.posts.index',
        'create'  => 'dashboard.posts.create',
        'store'   => 'dashboard.posts.store',
        'show'    => 'dashboard.posts.show',
        'edit'    => 'dashboard.posts.edit',
        'update'  => 'dashboard.posts.update',
        'destroy' => 'dashboard.posts.destroy',
    ]);
});