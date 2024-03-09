<?php

namespace App\Console\Commands;

use App\Models\ScheduleAutomaticBlog;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;

class GenerateDailyBlogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:daily-blogs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate daily blogs based on the schedule_automatic_blogs table';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = date('Y-m-d');
        $schedules = ScheduleAutomaticBlog::where('date', $today)->get();

        if ($schedules->isEmpty()) {
            $this->info('No schedules found for today.');
            return;
        }

        foreach ($schedules as $schedule) {
            Http::post(env('APP_URL') . '/api/generate-blog', [
                'keyword' => $schedule->keyword,
            ]);

        
            $this->info('Generated blog for keyword: ' . $schedule->keyword);
        }
    }
}
