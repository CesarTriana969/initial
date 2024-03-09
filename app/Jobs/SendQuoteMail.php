<?php

namespace App\Jobs;

use App\Mail\QuoteMail;
use App\Models\QuoteRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendQuoteMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $quoteRequest;

    /**
     * Create a new job instance.
     */
    public function __construct(QuoteRequest $quoteRequest)
    {
        $this->quoteRequest = $quoteRequest;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to($this->quoteRequest->email)->send(new QuoteMail($this->quoteRequest));
    }
}
