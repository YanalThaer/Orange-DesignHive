<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Models\Category;
use App\Models\Admin;
use App\Models\User;
use App\Models\Project;
use App\Models\Comment;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
        Paginator::useBootstrap();

        // Custom binding for Admin (includes soft-deleted)
        Route::bind('admin', function ($value) {
            return Admin::withTrashed()->findOrFail($value);
        });
    
        // Custom binding for User (includes soft-deleted)
        Route::bind('user', function ($value) {
            return User::withTrashed()->findOrFail($value);
        });

        // Project binding
        Route::bind('project', function ($value) {
            return Project::withTrashed()->findOrFail($value);
        });

        // Add Comment binding
        Route::bind('comment', function ($value) {
            return Comment::withTrashed()->findOrFail($value);
        });

        // Add Category binding
        Route::bind('category', function ($value) {
            return Category::withTrashed()->findOrFail($value);
        });


        view()->composer('admin.*', function ($view) {
            $view->with('currentAdmin', Auth::guard('admin')->user());
        });
    }
}
