<?php

namespace Modules\Subscription\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Subscription\Events\Handlers\RegisterSubscriptionSidebar;

class SubscriptionServiceProvider extends ServiceProvider
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
        $this->app['events']->listen(BuildingSidebar::class, RegisterSubscriptionSidebar::class);
    }

    public function boot()
    {
        $this->publishConfig('subscription', 'permissions');

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
            'Modules\Subscription\Repositories\SubscriptionRepository',
            function () {
                $repository = new \Modules\Subscription\Repositories\Eloquent\EloquentSubscriptionRepository(new \Modules\Subscription\Entities\Subscription());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Subscription\Repositories\Cache\CacheSubscriptionDecorator($repository);
            }
        );
// add bindings

    }
}
