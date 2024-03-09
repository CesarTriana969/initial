<?php

namespace App\Listeners;

use App\Events\CompanyProfileUpdated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Cache;

class UpdateCompanyProfileCache
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(CompanyProfileUpdated $event)
    {
        Cache::put('company_profile', $event->companyProfile);
    }
}
