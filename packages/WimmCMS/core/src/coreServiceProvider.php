<?php

namespace WimmCMS\core;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Http\Kernel;
use WimmCMS\core\Http\Middleware\Admin;

class coreServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot()
    {
        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'wimmcms');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'wimmcms');
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        $this->loadRoutesFrom(__DIR__.'/routes/api.php');
        
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/core.php', 'core');

        // Register the service the package provides.
        $this->app->singleton('core', function ($app) {
            return new core;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['core'];
    }
    
    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole()
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/core.php' => config_path('core.php'),
        ], 'core.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/wimmcms'),
        ], 'core.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/wimmcms'),
        ], 'core.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/wimmcms'),
        ], 'core.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
