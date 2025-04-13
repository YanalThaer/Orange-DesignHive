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
use App\Http\Controllers\TagController;


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
    Route::get('/admins/deleted', [AdminController::class, 'deleted'])->name('admins.deleted'); 
    Route::get('/admins/deleted/{admin}', [AdminController::class, 'showDeleted'])->name('admins.showdeleted');
    Route::post('/admins/{admin}/restore', [AdminController::class, 'restore'])->name('admins.restore'); 
    Route::get('/users/deleted', [UserController::class, 'deleted'])->name('users.deleted'); 
    Route::post('/users/{user}/restore', [UserController::class, 'restore'])->name('users.restore');
    Route::get('/users/deleted/{user}', [UserController::class, 'showDeleted'])->name('users.showdeleted');
    Route::get('/projects/deleted', [ProjectController::class, 'deleted'])->name('projects.deleted'); 
    Route::post('/projects/{project}/restore', [ProjectController::class, 'restore'])->name('projects.restore'); 
    Route::get('/projects/deleted/{project}', [ProjectController::class, 'showDeleted'])->name('projects.showdeleted'); 
    Route::get('/comments/deleted', [CommentController::class, 'deleted'])->name('comments.deleted');
    Route::post('/comments/{comment}/restore', [CommentController::class, 'restore'])->name('comments.restore');
    Route::get('/comments/deleted/{comment}', [CommentController::class, 'showDeleted'])->name('comments.showdeleted');
    Route::get('/categories/deleted', [CategoryController::class, 'deleted'])->name('categories.deleted');
    Route::post('/categories/{category}/restore', [CategoryController::class, 'restore'])->name('categories.restore');
    Route::get('/categories/deleted/{category}', [CategoryController::class, 'showDeleted'])->name('categories.showdeleted'); 
    Route::get('/tags/deleted', [TagController::class, 'deleted'])->name('tags.deleted'); 
    Route::post('/tags/{tags}/restore', [TagController::class, 'restore'])->name('tags.restore'); 
    Route::get('/tags/deleted/{tags}', [TagController::class, 'showDeleted'])->name('tags.showdeleted'); 
    Route::get('/subscription-plans', [SubscriptionController::class, 'indexPlans'])->name('subscription-plans.index');
    Route::resource('admins', AdminController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('comments', CommentController::class);
    Route::resource('payments', PaymentController::class);
    Route::resource('projects', ProjectController::class);
    Route::resource('tags', TagController::class);
    Route::resource('subscriptions', SubscriptionController::class);
    Route::resource('users', UserController::class);
});