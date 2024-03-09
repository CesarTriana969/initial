<?php

namespace App\Events;

use App\Models\CompanyProfile;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Cache;

class CompanyProfileUpdated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $companyProfile;

    /**
     * Create a new event instance.
     */
     public function __construct(CompanyProfile $companyProfile)
    {
        $this->companyProfile = $companyProfile;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('channel-name'),
        ];
    }

    public function handle()
    {
        Cache::put('companyProfile', $this->companyProfile);
    }
}
