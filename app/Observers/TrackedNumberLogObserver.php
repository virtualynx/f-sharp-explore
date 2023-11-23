<?php

namespace App\Observers;

use App\Models\TrackedNumberLog;
use Ramsey\Uuid\Uuid;

class TrackedNumberLogObserver
{
    public function creating(TrackedNumberLog $data): void
    {
        $data->uuid = Uuid::uuid4()->toString();
    }
    
    /**
     * Handle the TrackedNumberLog "created" event.
     */
    public function created(TrackedNumberLog $trackedNumberLog): void
    {
        //
    }

    /**
     * Handle the TrackedNumberLog "updated" event.
     */
    public function updated(TrackedNumberLog $trackedNumberLog): void
    {
        //
    }

    /**
     * Handle the TrackedNumberLog "deleted" event.
     */
    public function deleted(TrackedNumberLog $trackedNumberLog): void
    {
        //
    }

    /**
     * Handle the TrackedNumberLog "restored" event.
     */
    public function restored(TrackedNumberLog $trackedNumberLog): void
    {
        //
    }

    /**
     * Handle the TrackedNumberLog "force deleted" event.
     */
    public function forceDeleted(TrackedNumberLog $trackedNumberLog): void
    {
        //
    }
}
