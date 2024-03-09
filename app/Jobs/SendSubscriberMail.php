<?php

namespace App\Jobs;

use App\Mail\SubscriberMail;
use App\Models\CompanyProfile;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendSubscriberMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $company, $email;

    /**
     * Create a new job instance.
     */
    public function __construct(CompanyProfile $company, $email)
    {
        $this->company = $company;
        $this->email = $email;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->email)->send(new SubscriberMail($this->company));

    }
}
