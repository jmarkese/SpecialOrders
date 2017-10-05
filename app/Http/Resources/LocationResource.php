<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class LocationResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $this->resource->setVisible([
            'name',
        ]);

        return [
            "type" => "locations",
            "id" => $this->resource->id,
            "attributes" => $this->resource->toArray(),
            "links" => [
                "self" => route('locations.show', $this->resource)
            ],
        ];
    }
}
