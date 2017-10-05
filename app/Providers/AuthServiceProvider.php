<?php

namespace App\Providers;

use App\Order;
use App\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        foreach ( \App\Permission::all() as $permission) {
            Gate::define($permission->name, function ($user) use ($permission) {
                return $user->hasRole($permission->roles);
            });
        }

        $this->registerOrderPolicies();

    }

    private function registerOrderPolicies()
    {
        Gate::define('order_location', function (User $user, Order $order) {
            return $user->location == $order->location || $user->hasPermission(['manage_orders']);
        });
    }
}
