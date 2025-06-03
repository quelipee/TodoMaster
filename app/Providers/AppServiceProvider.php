<?php

namespace App\Providers;

use App\TodoList\Services\TodoListService;
use App\TodoList\TodoListContracts;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application Services.
     */
    public function register(): void
    {
        $this->app->singleton(TodoListContracts::class, fn() => new TodoListService());
    }

    /**
     * Bootstrap any application Services.
     */
    public function boot(): void
    {
        //
    }
}
