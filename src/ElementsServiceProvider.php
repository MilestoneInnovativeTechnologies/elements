<?php

namespace Milestone\Elements;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;


class ElementsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/elements.php','elements');
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if($this->app->runningInConsole()){
            $this->loadMigrationsFrom(__DIR__.'/../migrations');
//            $this->publishes([__DIR__ . '/../public' => public_path()],['elements-updates']);
            $this->publishes([__DIR__ . '/../config/elements.php' => config_path('elements.php')],['elements-config']);
            $this->publishes([__DIR__ . '/../data' => storage_path('app')],'elements-data');
        } else {
//            Route::pattern('elements_segments', '.*');
//            $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
            $this->loadViewsFrom(__DIR__ . '/../views','Elements');
            Route::group(['middleware' => ['web']], function () {
                $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');
            });
        }
    }
}
