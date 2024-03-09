<?php

namespace App\Http\Resources\Customer;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'customers',
            'id' => (string) $this->resource->getRouteKey(),
            'attributes' => [
                'first_name' => $this->resource->first_name,
                'last_name' => $this->resource->last_name,
                'email' => $this->resource->email,
                'phone_number' => $this->resource->phone_number,
                'company_name' => $this->resource->company_name,
                'birth_day' => $this->resource->birth_day,
                'address' => $this->resource->address,
                'apt' => $this->resource->apt,
                'city' => $this->resource->city,
                'state' => $this->resource->state,
                'zip_code' => $this->resource->zip_code,
            ]
        ];
    }
}
