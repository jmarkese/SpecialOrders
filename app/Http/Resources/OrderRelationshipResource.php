<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class OrderRelationshipResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'location' => [
                'links' => [
                    'self' => route('orders.relationships.location', ['orders' => $this->id]),
                    'related' => route('orders.location', ['orders' => $this->id]),
                ],
                'data' => new LocationResource($this->location),
            ],
        ];
    }
}
