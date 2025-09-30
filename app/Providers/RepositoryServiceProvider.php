<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Interfaces\TodoRepositoryInterface;
use App\Repositories\TodoRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(TodoRepositoryInterface::class, TodoRepository::class);
    }

    public function boot(): void
    {
        //
    }
}
