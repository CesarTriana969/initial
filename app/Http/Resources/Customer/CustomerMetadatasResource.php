<?php

namespace App\Http\Resources\Customer;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerMetadatasResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'customer_metadata',
            'id' => $this->id,
            'attributes' => [
                'appointment_id' => $this->resource->appointment_id,
                'meta_key' => $this->resource->meta_key,
                'meta_value' => $this->resource->meta_value,
                'file' => $this->file
            ]
        ];
    }
}
