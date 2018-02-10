<?php

namespace Thesold\LaravelMediaManager;

use Illuminate\Support\ServiceProvider;

class MediaServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootConfig();
        $this->bootRoutes();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerConfig();
        $this->registerBindings();
    }

    private function bootRoutes()
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
    }

    private function registerBindings()
    {
        $mediaManagerDriver = ucfirst(config('laravelmediamanager.driver'));

        $libraryClass = "Thesold\LaravelMediaManager\Adapters\\{$mediaManagerDriver}MediaLibrary";
        $adapterClass = "Thesold\LaravelMediaManager\Adapters\\{$mediaManagerDriver}MediaAdapter";

        $this->app->singleton('Thesold\LaravelMediaManager\Contracts\MediaLibrary', $libraryClass);
        $this->app->singleton('Thesold\LaravelMediaManager\Contracts\MediaAdapter', $adapterClass);
    }

    private function bootConfig()
    {
        $this->publishes([
            __DIR__.'/config/laravelmediamanager.php' => config_path('laravelmediamanager.php')
        ]);
    }

    private function registerConfig()
    {
        $this->mergeConfigFrom(__DIR__.'/config/laravelmediamanager.php', 'laravelmediamanager');
    }
}
