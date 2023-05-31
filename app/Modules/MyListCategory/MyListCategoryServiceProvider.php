<?php

namespace App\Modules\MyListCategory;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Support\ServiceProvider as BaseServiceProvider;

class MyListCategoryServiceProvider extends BaseServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(GateContract $gate)
    {
        if (!$this->app->routesAreCached()) {
            require __DIR__ . '/MyListCategoryRoutes.php';
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
