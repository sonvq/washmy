<?php

namespace Modules\Customer\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Customer\Events\Handlers\RegisterCustomerSidebar;

class CustomerServiceProvider extends ServiceProvider
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
        $this->app['events']->listen(BuildingSidebar::class, RegisterCustomerSidebar::class);
    }

    public function boot()
    {
        $this->publishConfig('customer', 'permissions');

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
            'Modules\Customer\Repositories\CustomerRepository',
            function () {
                $repository = new \Modules\Customer\Repositories\Eloquent\EloquentCustomerRepository(new \Modules\Customer\Entities\Customer());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Customer\Repositories\Cache\CacheCustomerDecorator($repository);
            }
        );
// add bindings
        $this->app->bind(
            'Modules\Customer\Transformers\CustomerTransformerInterface', 
            "Modules\\Customer\\Transformers\\CustomerTransformer"
        );
    }
}
