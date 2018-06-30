<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\RegisterEvent' => [
            \App\Listeners\RegisterNotify::class,
        ],
        'Illuminate\Database\Events\QueryExecuted' => [
            \App\Listeners\QueryListener::class,
        ],
        'App\Events\LoginEvent' => [
            \App\Listeners\LoginListener::class,
        ],
        'App\Events\LogoutEvent' => [
            \App\Listeners\LogoutListener::class,
        ],
        'App\Events\LockoutEvent' => [
            \App\Listeners\LoginLockoutListener::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
        //
    }
}
