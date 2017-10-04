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

        $this->resource->setVisible([
            'created_at',
            'content',
        ]);

        $attributes = [
            'user' => new UserResource($this->resource->user),
        ];

        return [
            "type" => "notes",
            "id" => $this->id,
            "attributes" => $attributes + $this->resource->toArray(),
            "links" => [
                "self" => route('notes.show', $this)
            ],
        ];
    }

}
