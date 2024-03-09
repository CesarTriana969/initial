<?php

namespace App\Actions\Panel\Blog\Schedule;

use App\Actions\Panel\Blog\Schedule\Interfaces\ScheduleInterface;
use App\Models\ScheduleAutomaticBlog;
use Illuminate\Http\JsonResponse;

class ScheduleAction implements ScheduleInterface
{
    public function schedules($request): JsonResponse
    {
        $search = $request->search;
        $authors = ScheduleAutomaticBlog::where('id', 'LIKE', '%'.$search.'%')
                ->orwhere('date', 'LIKE', '%'.$search.'%')
                ->orwhere('keyword', 'LIKE', '%'.$search.'%')
                ->orderBy('id', 'desc')
                ->paginate();

        return response()->json($authors);
    }

    public function store( $request): JsonResponse
    {
        $data = $request->validate([
            'date' => 'required|date|max:255',
            'keyword' => 'required|string|max:255',
        ]);

        $schedule = ScheduleAutomaticBlog::create($data);

        return response()->json(['success' => true, 'schedule' => $schedule]);
    }

    public function delete(ScheduleAutomaticBlog $schedule): JsonResponse
    {
        if ($schedule) {
            $schedule->delete();
            return response()->json(['success' => true]);
        }
        return response()->json(['error' => 'Schedule not found'], 404);
    }
}
