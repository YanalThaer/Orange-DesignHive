<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\UserController;


Auth::routes();

Route::fallback(function () {
    return response()->view('public.pages.404');
});

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::fallback([HomeController::class, 'fallback']);

Route::get('/category',[HomeController::class, 'category'])->name('category');

Route::get('/add-project',[HomeController::class, 'addProject'])->name('add.project');
Route::post('/store-project',[HomeController::class, 'storeProject'])->name('store.project');

Route::get('/projects/{id}/edit',[HomeController::class, 'editProject'])->name('edit.project');
Route::put('/projects/{id}',[HomeController::class, 'updateProject'])->name('update.project');
Route::delete('/projects/{id}',[HomeController::class, 'destroyProject'])->name('delete.project');

Route::get('/chat/{receiver_id}', [HomeController::class, 'indexChat'])->name('chat.index');
Route::post('/chat/send', [HomeController::class, 'sendMessage'])->name('chat.send');
Route::get('/chat/fetch/{receiver_id}', [HomeController::class, 'fetchMessages'])->name('chat.fetch');

Route::get('/search', [HomeController::class, 'search'])->name('search');

Route::get('/about',[HomeController::class, 'about'])->name('about');

Route::get('/contact',[HomeController::class, 'contact'])->name('contact');
Route::post('/contact/store',[HomeController::class, 'storeContact'])->name('store.contact');

Route::get('/project-details/{id}', [HomeController::class, 'showProject'])->name('project.details');

Route::get('/post/{id}',[HomeController::class, 'post'])->name('category.posts');
Route::get('/projects/tag/{tagId}', [HomeController::class, 'filterByTag'])->name('projects.byTag');

Route::get('/profile/{id}',[HomeController::class, 'profile'])->name('profile');

Route::get('/users/{user}/edit', [HomeController::class, 'editUser'])->name('usersprofile.edit');
Route::put('/users/{user}', [HomeController::class, 'updateUser'])->name('usersprofile.update');
Route::delete('/usersprofile/{user}', [HomeController::class, 'destroyUser'])->name('usersprofile.destroy');

Route::post('/toggle-like', [LikeController::class, 'toggleLike'])->name('toggle.like');

Route::post('/project-comments/{id}', [HomeController::class, 'storeComments'])->name('projects.comments.store');

Route::get('/subecribtion', [HomeController::class, 'subecribtion'])->name('subecribtion');
Route::get('/payment', [HomeController::class, 'payment'])->name('payment');

Route::post('/destroy', [LoginController::class, 'destroy'])->name('logoutusers');

Route::get('/verify-email', [RegisterController::class, 'verifyEmail'])->name('verify.email.form');

Route::post('/verify-email', [RegisterController::class, 'verifyCode'])->name('verify.email.code');

Route::get('/auth/google', [RegisterController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [RegisterController::class, 'handleGoogleCallback'])->name('auth.google.callback');


// admin
Route::prefix('admin')->middleware('isAdmin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('admins', AdminController::class)->middleware('superadmin');
    Route::resource('categories', CategoryController::class);
    Route::resource('comments', CommentController::class);
    Route::resource('payments', PaymentController::class);
    Route::resource('projects', ProjectController::class);
    // Route::resource('subscriptions', SubscriptionController::class);
    Route::resource('users', UserController::class);
});