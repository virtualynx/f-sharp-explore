<?php

namespace App\Observers;

use App\Models\SearchLogLocateMsisdn;
use Ramsey\Uuid\Uuid;

class SearchLogLocateMsisdnObserver
{
    public function creating(SearchLogLocateMsisdn $data): void
    {
        $data->uuid = Uuid::uuid4()->toString();
    }

    /**
     * Handle the SearchLogLocateMsisdn "created" event.
     */
    public function created(SearchLogLocateMsisdn $data): void
    {
        //
    }

    /**
     * Handle the SearchLogLocateMsisdn "updated" event.
     */
    public function updated(SearchLogLocateMsisdn $data): void
    {
        //
    }

    /**
     * Handle the SearchLogLocateMsisdn "deleted" event.
     */
    public function deleted(SearchLogLocateMsisdn $data): void
    {
        //
    }

    /**
     * Handle the SearchLogLocateMsisdn "restored" event.
     */
    public function restored(SearchLogLocateMsisdn $data): void
    {
        //
    }

    /**
     * Handle the SearchLogLocateMsisdn "force deleted" event.
     */
    public function forceDeleted(SearchLogLocateMsisdn $data): void
    {
        //
    }
}
