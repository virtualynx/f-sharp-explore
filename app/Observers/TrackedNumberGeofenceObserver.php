<?php

namespace App\Observers;

use App\Models\TrackedNumberGeofence;
use Ramsey\Uuid\Uuid;

class TrackedNumberGeofenceObserver
{
    public function creating(TrackedNumberGeofence $data): void
    {
        $data->geo_uuid = Uuid::uuid4()->toString();
    }
    
    /**
     * Handle the TrackedNumberGeofence "created" event.
     */
    public function created(TrackedNumberGeofence $trackedNumberGeofence): void
    {
        //
    }

    /**
     * Handle the TrackedNumberGeofence "updated" event.
     */
    public function updated(TrackedNumberGeofence $trackedNumberGeofence): void
    {
        //
    }

    /**
     * Handle the TrackedNumberGeofence "deleted" event.
     */
    public function deleted(TrackedNumberGeofence $trackedNumberGeofence): void
    {
        //
    }

    /**
     * Handle the TrackedNumberGeofence "restored" event.
     */
    public function restored(TrackedNumberGeofence $trackedNumberGeofence): void
    {
        //
    }

    /**
     * Handle the TrackedNumberGeofence "force deleted" event.
     */
    public function forceDeleted(TrackedNumberGeofence $trackedNumberGeofence): void
    {
        //
    }
}
