<?php

namespace App\Http\Resources\Schedule;

use App\Http\Resources\Customer\CustomerMetadatasResource;
use App\Http\Resources\Customer\CustomerResource;
use App\Http\Resources\Service\ServiceResource;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetUsersAppointmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'appointments',
            'id' => (string) $this->id,
            'attributes' => [
                'id' => $this->id,
                'title' => $this->title,
                'start' => $this->date.'T'.$this->start_time,
                'end' => $this->date.'T'.$this->end_time,
                'start_modal' => $this->start_time,
                'end_modal' => $this->end_time,
                'date' => $this->date,
                // 'color' => $this->color ,
                'color' => $this->user->color,
                'status' => $this->status ,
                'created_at' => $this->created_at->format('Y-m-d h:m:s'),
                'files' => $this->files
            ],
            'relationships' => [
                'user' => UserResource::make($this->user),
                'customer' => CustomerResource::make($this->customer),
                'service' => ServiceResource::make($this->service),
                'metadata' => CustomerMetadatasResource::collection($this->metadatas),
            ],
        ];
    }
}
