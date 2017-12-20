<?php

namespace Modules\Rating\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Rating\Events\Handlers\RegisterRatingSidebar;

class RatingServiceProvider extends ServiceProvider
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
        $this->app['events']->listen(BuildingSidebar::class, RegisterRatingSidebar::class);
    }

    public function boot()
    {
        $this->publishConfig('rating', 'permissions');
        $this->publishConfig('rating', 'config');
        $this->publishConfig('rating', 'validations');

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
            'Modules\Rating\Repositories\RatingRepository',
            function () {
                $repository = new \Modules\Rating\Repositories\Eloquent\EloquentRatingRepository(new \Modules\Rating\Entities\Rating());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Rating\Repositories\Cache\CacheRatingDecorator($repository);
            }
        );
// add bindings
        $this->app->bind(
            'Modules\Rating\Transformers\RatingTransformerInterface', 
            "Modules\\Rating\\Transformers\\RatingTransformer"
        );
    }
}
