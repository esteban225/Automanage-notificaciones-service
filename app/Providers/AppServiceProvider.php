<?php

namespace App\Providers;

use App\Core\Application\UseCases\NotificacionServiceInterface;
use App\Infrastructure\Services\NotificacionRabbitMQService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(NotificacionServiceInterface::class, NotificacionRabbitMQService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
