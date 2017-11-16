<?php

namespace Modules\Washer\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Washer\Events\Handlers\RegisterWasherSidebar;

class WasherServiceProvider extends ServiceProvider
{
    use CanPublishConfiguration;
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
        $this->app['events']->listen(BuildingSidebar::class, RegisterWasherSidebar::class);
    }

    public function boot()
    {
        $this->publishConfig('washer', 'permissions');

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
            'Modules\Washer\Repositories\WasherRepository',
            function () {
                $repository = new \Modules\Washer\Repositories\Eloquent\EloquentWasherRepository(new \Modules\Washer\Entities\Washer());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Washer\Repositories\Cache\CacheWasherDecorator($repository);
            }
        );
// add bindings
        $this->app->bind(
            'Modules\Washer\Transformers\WasherTransformerInterface', 
            "Modules\\Washer\\Transformers\\WasherTransformer"
        );
    }
}
