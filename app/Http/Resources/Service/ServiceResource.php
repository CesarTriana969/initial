<?php

namespace App\Http\Resources\Service;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ServiceResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'tax_services',
            'id' =>$this->resource->getRouteKey(),
            'attributes' => [
                'service_name' => $this->resource->service_name, 
                'description'  => $this->resource->description, 
                'price'  => $this->resource->price, 
                'estimated_duration'  => $this->resource->estimated_duration, 
                'frequency'  => $this->resource->frequency, 
                'last_updated'  => $this->resource->last_updated, 
                'observations'  => $this->resource->observations, 
                'client_category ' => $this->resource->client_category,
                'link_more_info'  => $this->resource->link_more_info, 
                'status'  => $this->resource->status
            ]
        ];
    }
}
