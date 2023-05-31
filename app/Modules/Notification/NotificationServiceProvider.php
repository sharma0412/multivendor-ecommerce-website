<?php

namespace App\Modules\Notification;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class NotificationServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {
        if (!$this->app->routesAreCached()) {
            require __DIR__ . '/NotificationRoutes.php';
        }

        // $gate->policy(Pos::class, PosPolicy::class);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }
}
