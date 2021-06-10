<?php

namespace Modules\Register\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Traits\CanGetSidebarClassForModule;
use Modules\Register\Composers\CollateralComposer;
use Modules\Register\Events\Handlers\RegisterRegisterSidebar;

class RegisterServiceProvider extends ServiceProvider
{
    use CanPublishConfiguration, CanGetSidebarClassForModule;
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();

        $this->app->extend('asgard.ModulesList', function($app) {
            array_push($app, 'register');
            return $app;
        });

        view()->composer('register::*', CollateralComposer::class);

        $this->app['events']->listen(
            BuildingSidebar::class,
            $this->getSidebarClassForModule('Register', RegisterRegisterSidebar::class)
        );
    }

    public function boot()
    {
        $this->publishConfig('register', 'permissions');
        $this->publishConfig('register', 'config');
        $this->publishConfig('register', 'settings');

        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

    private function registerBindings()
    {
        $this->app->bind(
            'Modules\Register\Repositories\FormRepository',
            function () {
                $repository = new \Modules\Register\Repositories\Eloquent\EloquentFormRepository(new \Modules\Register\Entities\Form());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Register\Repositories\Cache\CacheFormDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Register\Repositories\CollateralRepository',
            function () {
                $repository = new \Modules\Register\Repositories\Eloquent\EloquentCollateralRepository(new \Modules\Register\Entities\Collateral());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Register\Repositories\Cache\CacheCollateralDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Register\Repositories\FileRepository',
            function () {
                $repository = new \Modules\Register\Repositories\Eloquent\EloquentFileRepository(new \Modules\Register\Entities\File());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Register\Repositories\Cache\CacheFileDecorator($repository);
            }
        );
// add bindings



    }
}
