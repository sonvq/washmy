<?php

namespace Modules\Authentication\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Authentication\Events\Handlers\RegisterAuthenticationSidebar;
use Modules\Authentication\Repositories\Eloquent\EloquentWasherCustomerLoginRepository;
use Modules\Authentication\Entities\WasherCustomerLogin;

use Modules\Authentication\Repositories\Eloquent\EloquentWasherCustomerDeviceRepository;
use Modules\Authentication\Entities\WasherCustomerDevice;

use Modules\Authentication\Repositories\Eloquent\EloquentWasherCustomerForgotRepository;
use Modules\Authentication\Entities\WasherCustomerForgot;

class AuthenticationServiceProvider extends ServiceProvider
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
        $this->app['events']->listen(BuildingSidebar::class, RegisterAuthenticationSidebar::class);
    }

    public function boot()
    {
        $this->publishConfig('authentication', 'permissions');
        $this->publishConfig('authentication', 'validations');

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
// add bindings
        $this->app->bind(
            'Modules\Authentication\Repositories\WasherCustomerLoginRepository',
            function () {
                return new EloquentWasherCustomerLoginRepository(
                    new WasherCustomerLogin()
                );
            }
        );
        
        $this->app->bind(
            'Modules\Authentication\Repositories\WasherCustomerDeviceRepository',
            function () {
                return new EloquentWasherCustomerDeviceRepository(
                    new WasherCustomerDevice()
                );
            }
        );
        
        $this->app->bind(
            'Modules\Authentication\Repositories\WasherCustomerForgotRepository',
            function () {
                return new EloquentWasherCustomerForgotRepository(
                    new WasherCustomerForgot()
                );
            }
        );
    }
}
