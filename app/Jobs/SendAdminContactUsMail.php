<?php

namespace App\Jobs;

use App\Mail\Admin\ContactUsMail;
use App\Models\CompanyProfile;
use App\Models\ContactUs;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendAdminContactUsMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $contact, $email;

    /**
     * Create a new job instance.
     */
    public function __construct(ContactUs $contact, $email)
    {
        $this->contact = $contact;
        $this->email = $email;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->email)->send(new ContactUsMail($this->contact));
    }
}
