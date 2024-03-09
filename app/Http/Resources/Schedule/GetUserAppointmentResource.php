<?php

namespace App\Http\Resources\Schedule;

use App\Http\Resources\Customer\CustomerMetadatasResource;
use App\Http\Resources\Customer\CustomerResource;
use App\Http\Resources\Customer\SupportResouce;
use App\Http\Resources\Service\ServiceResource;
use App\Http\Resources\User\UserResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GetUserAppointmentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        if(!$this->confirmed){
            $color = '#FCBC03';
        }else if($this->status){
            $color = '#32B67A';
        }else{
            $color = '#039BE6';
        }

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
                'color' => $color,
                'status' => $this->status,
                'confirmed' => $this->confirmed,
                'reason' => $this->reason,
                'created_at' => $this->created_at->format('Y-m-d h:m:s'),
                'files' => $this->files
            ],
            'relationships' => [
                'user' => UserResource::make($this->user),
                'customer' => CustomerResource::make($this->customer),
                'service' => ServiceResource::make($this->service),
                'metadata' => CustomerMetadatasResource::collection($this->metadatas),
                'supports' => SupportResouce::collection($this->supports),
            ],
        ];
    }
}
