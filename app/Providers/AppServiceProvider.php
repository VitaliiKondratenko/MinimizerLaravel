<?php

namespace App\Providers;

use App\Http\Services\Interfaces\LinkServiceInterface;
use App\Http\Services\LinkService;
use App\Models\Repositories\Interfaces\LinkRepositoryInterface;
use App\Models\Repositories\LinkRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(LinkServiceInterface::class, LinkService::class);
        $this->app->bind(LinkRepositoryInterface::class, LinkRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
