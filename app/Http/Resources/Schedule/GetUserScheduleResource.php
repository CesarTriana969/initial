<?php

namespace App\Http\Resources\Schedule;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetUserScheduleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->getRouteKey(),
            'daysOfWeek' => $this->resource->day_of_week,
            'startTime' => $this->resource->start_time,
            'endTime' => $this->resource->end_time,
            'color' => $this->resource->color,
        ];
    }
}
