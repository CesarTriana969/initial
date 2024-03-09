<?php

namespace App\Http\Controllers;

use App\Actions\Panel\Blog\Schedule\Interfaces\ScheduleInterface;
use App\Models\ScheduleAutomaticBlog;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ScheduleBlogController extends Controller
{
    protected $scheduleInterface;

    public function __construct(ScheduleInterface $scheduleInterface)
    {
        $this->scheduleInterface = $scheduleInterface;

        $this->middleware('permission:view-blogs', ['only'=>['index','schedules']]);
        $this->middleware('permission:create-blog', ['only'=>['store']]);
        $this->middleware('permission:delete-blog', ['only'=>['delete']]);
    }

    public function index(): Renderable
    {
        return view('admin.blogs.schedules.index');
    }

    public function schedules(Request $request): JsonResponse
    {
        return $this->scheduleInterface->schedules($request);
    }

    public function store(Request $request): JsonResponse
    {
        return $this->scheduleInterface->store($request);
    }

    public function delete(ScheduleAutomaticBlog $schedule): JsonResponse
    {
        return $this->scheduleInterface->delete($schedule);
    }
}
