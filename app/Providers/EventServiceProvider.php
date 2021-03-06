<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
//        'App\Events\Event' => [
//            'App\Listeners\EventListener',
//        ],
        'App\Events\Register' => [
            'App\Listeners\RegisterNotify',
        ],
        'Illuminate\Database\Events\QueryExecuted' => [
            'App\Listeners\QueryListener',
        ],
        'App\Events\LoginEvent' => [
            'App\Listeners\LoginListener',
        ],
        'App\Events\LogoutEvent' => [
            'App\Listeners\LogoutListener',
        ],
        'App\Events\LockoutEvent' => [
            'App\Listeners\LoginLockoutListener',
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
