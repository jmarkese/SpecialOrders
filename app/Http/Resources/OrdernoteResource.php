<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class OrdernoteResource extends Resource
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
            'user' => $this->resource->user->user_name,
        ];

        return [
            "type" => "notes",
            "id" => (string)$this->id,
            "attributes" => $attributes + $this->resource->toArray(),
            "links" => [
                "self" => route('notes.show', $this)
            ],
        ];
    }
}
