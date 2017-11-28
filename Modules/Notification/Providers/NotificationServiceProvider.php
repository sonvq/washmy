<?php

namespace Modules\Notification\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Notification\Events\Handlers\RegisterNotificationSidebar;

class NotificationServiceProvider extends ServiceProvider
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
        $this->app['events']->listen(BuildingSidebar::class, RegisterNotificationSidebar::class);
    }

    public function boot()
    {
        $this->publishConfig('notification', 'permissions');

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
            'Modules\Notification\Repositories\NotificationRepository',
            function () {
                $repository = new \Modules\Notification\Repositories\Eloquent\EloquentNotificationRepository(new \Modules\Notification\Entities\Notification());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Notification\Repositories\Cache\CacheNotificationDecorator($repository);
            }
        );
// add bindings

    }
}
