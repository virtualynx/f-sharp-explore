<?php

namespace App\Providers;

use App\Models\SearchLogLocateMsisdn;
use App\Models\TrackedNumberGeofence;
use App\Models\TrackedNumberGeofenceBreach;
use App\Models\TrackedNumberLog;
use App\Observers\SearchLogLocateMsisdnObserver;
use App\Observers\TrackedNumberGeofenceBreachObserver;
use App\Observers\TrackedNumberGeofenceObserver;
use App\Observers\TrackedNumberLogObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event to listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     */
    public function boot(): void
    {
        TrackedNumberLog::observe(TrackedNumberLogObserver::class);
        TrackedNumberGeofence::observe(TrackedNumberGeofenceObserver::class);
        TrackedNumberGeofenceBreach::observe(TrackedNumberGeofenceBreachObserver::class);
        SearchLogLocateMsisdn::observe(SearchLogLocateMsisdnObserver::class);
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}
