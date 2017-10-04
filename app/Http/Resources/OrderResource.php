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
        $this->resource->setVisible([
                'created_at',
                'part_num',
                'description',
                'qty',
                'customer_name',
                'customer_contact',
                'customer_deposit',
                'emlpoyee_name',
        ]);

        $attributes = [
            'status' => $this->resource->status,
            'vendor' => $this->resource->vendor,
            'category' => $this->resource->category,
            'notes' => new OrdernoteResourceCollection($this->resource->notes)
        ];

        return [
            "type" => "orders",
            "id" => $this->id,
            "attributes" => $attributes + $this->resource->toArray(),
            "links" => [
                "self" => route('orders.show', $this)
            ],
        ];
    }
}
