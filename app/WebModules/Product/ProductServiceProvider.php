<?php

namespace App\WebModules\Product;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class ProductServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {
        if (!$this->app->routesAreCached()) {
            require __DIR__ . '/ProductRoutes.php';
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
