<?php

namespace App\Http\Resources\Customer;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SupportResouce extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'type' => 'supports',
            'id' => (string) $this->resource->getRouteKey(),
            'attributes' => [
                'first_name' => $this->resource->first_name,
                'middle' => $this->resource->middle,
                'generation' => $this->resource->generation,
                'birth_date' => $this->resource->birth_date,
                'citizenship' => $this->resource->citizenship,
                'ssn_or_itin_support' => $this->resource->ssn_or_itin_support,
            ]
        ];
    }
}
