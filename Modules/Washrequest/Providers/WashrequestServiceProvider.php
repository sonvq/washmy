<?php

namespace Modules\Washrequest\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Washrequest\Events\Handlers\RegisterWashrequestSidebar;

class WashrequestServiceProvider extends ServiceProvider
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
        $this->app['events']->listen(BuildingSidebar::class, RegisterWashrequestSidebar::class);
    }

    public function boot()
    {
        $this->publishConfig('washrequest', 'permissions');
        $this->publishConfig('washrequest', 'validations');

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
            'Modules\Washrequest\Repositories\WashrequestRepository',
            function () {
                $repository = new \Modules\Washrequest\Repositories\Eloquent\EloquentWashrequestRepository(new \Modules\Washrequest\Entities\Washrequest());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Washrequest\Repositories\Cache\CacheWashrequestDecorator($repository);
            }
        );
// add bindings

        $this->app->bind(
            'Modules\Washrequest\Transformers\WashrequestTransformerInterface', 
            "Modules\\Washrequest\\Transformers\\WashrequestTransformer"
        );
    }
}
