<?php

namespace App\Providers;

use App\Domain\Orders\Events\UpdateLeaveApplicationStatus;
use App\Domain\Orders\Listeners\SendUserNotification;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // $this->app->singleton('UserUtilsFacade', function ($app) {
        //     return new UserUtilsFacade();
        // });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen(
            UpdateLeaveApplicationStatus::class,
            SendUserNotification::class,
        );
    }
}
