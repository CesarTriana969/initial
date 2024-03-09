<?php

namespace App\Actions\Panel\Blog\Schedule\Interfaces;

use App\Models\ScheduleAutomaticBlog;

interface ScheduleInterface
{
    public function schedules($request);
    public function store($request);
    public function delete(ScheduleAutomaticBlog $schedule);
}
