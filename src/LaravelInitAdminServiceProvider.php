<?php

namespace Smoetje\LaravelInitAdmin;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;
use Smoetje\LaravelInitAdmin\Http\Middleware\InitApplication;
use Smoetje\LaravelInitAdmin\Http\Middleware\IsAdmin;

class LaravelInitAdminServiceProvider extends ServiceProvider
{
    /**
     * Perform post-registration booting of services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__.'/routes/web.php');
        $this->loadViewsFrom(__DIR__.'/resources/views', 'laravelinitadmin');

//        $this->loadViewComponentsAs('courier', [
//            Alert::class,
//            Button::class,
//        ]); // die error moet er nog uit, zie comemented view compenent in blade



        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        $router = $this->app->make(Router::class);
        $router->pushMiddlewareToGroup('web', InitApplication::class);
        $router->aliasMiddleware('is_admin', IsAdmin::class);

        // $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'smoetje');
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'smoetje');
        // $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        // $this->loadRoutesFrom(__DIR__.'/routes.php');

        // Publishing is only necessary when using the CLI.
        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    /**
     * Register any package services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__.'/../config/laravel-init-admin.php', 'laravel-init-admin');

        // Register the service the package provides.
        $this->app->singleton('laravel-init-admin', function ($app) {
            return new LaravelInitAdmin;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['laravel-init-admin'];
    }

    /**
     * Console-specific booting.
     *
     * @return void
     */
    protected function bootForConsole(): void
    {
        // Publishing the configuration file.
        $this->publishes([
            __DIR__.'/../config/laravel-init-admin.php' => config_path('laravel-init-admin.php'),
        ], 'laravel-init-admin.config');

        // Publishing the views.
        /*$this->publishes([
            __DIR__.'/../resources/views' => base_path('resources/views/vendor/smoetje'),
        ], 'laravel-init-admin.views');*/

        // Publishing assets.
        /*$this->publishes([
            __DIR__.'/../resources/assets' => public_path('vendor/smoetje'),
        ], 'laravel-init-admin.views');*/

        // Publishing the translation files.
        /*$this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/smoetje'),
        ], 'laravel-init-admin.views');*/

        // Registering package commands.
        // $this->commands([]);
    }
}
