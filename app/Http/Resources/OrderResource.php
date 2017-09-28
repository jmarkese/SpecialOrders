<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class OrderResource extends Resource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $attributes = [
            'status' => $this->resource->status->name,
            'vendor' => $this->resource->vendor->name,
            'category' => $this->resource->category->name,
        ];

        return [
            "type" => "orders",
            "id" => (string)$this->id,
            "attributes" => $attributes + $this->resource->toArray(),
            "links" => [
                "self" => route('orders.show', $this)
            ],
            "relations" => new OrderRelationshipResource($this->resource),
            "meta" => [],
        ];
    }
}
