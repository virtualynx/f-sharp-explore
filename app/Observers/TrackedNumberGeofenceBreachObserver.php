<?php

namespace App\Observers;

use App\Models\TrackedNumberGeofenceBreach;
use Ramsey\Uuid\Uuid;

class TrackedNumberGeofenceBreachObserver
{
    /**
     * Handle the TrackedNumberGeofenceBreach "created" event.
     */
    public function created(TrackedNumberGeofenceBreach $trackedNumberGeofenceBreach): void
    {
        $trackedNumberGeofenceBreach->geo_breach_uuid = Uuid::uuid4()->toString();
        $trackedNumberGeofenceBreach->save();
    }

    /**
     * Handle the TrackedNumberGeofenceBreach "updated" event.
     */
    public function updated(TrackedNumberGeofenceBreach $trackedNumberGeofenceBreach): void
    {
        //
    }

    /**
     * Handle the TrackedNumberGeofenceBreach "deleted" event.
     */
    public function deleted(TrackedNumberGeofenceBreach $trackedNumberGeofenceBreach): void
    {
        //
    }

    /**
     * Handle the TrackedNumberGeofenceBreach "restored" event.
     */
    public function restored(TrackedNumberGeofenceBreach $trackedNumberGeofenceBreach): void
    {
        //
    }

    /**
     * Handle the TrackedNumberGeofenceBreach "force deleted" event.
     */
    public function forceDeleted(TrackedNumberGeofenceBreach $trackedNumberGeofenceBreach): void
    {
        //
    }
}
