<?php

namespace App\Providers;

use App\TestRepo\MyStudentRepositoryInterface;
use App\TestRepo\Interface\ParentRepositorty;
use App\TestRepo\ParentRepositoryInterface;
use App\TestRepo\Interface\MyStudentRepository;
use Illuminate\Support\ServiceProvider;

class TestRepoServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(ParentRepositoryInterface::class,ParentRepositorty::class);
        $this->app->bind(MyStudentRepositoryInterface::class,MyStudentRepository::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
