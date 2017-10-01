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
            'notes' => $this->notesRelation($request),
            'location' => [
                'links' => [
                    'self' => route('orders.relationships.location', ['orders' => $this->id]),
                    'related' => route('orders.location', ['orders' => $this->id]),
                ],
                'data' => new LocationResource($this->location),
            ],
            'user' => [
                'links' => [
                    'self' => route('orders.relationships.user', ['orders' => $this->id]),
                    'related' => route('orders.user', ['orders' => $this->id]),
                ],
                'data' => new UserResource($this->user),
            ],

        ];
    }

    private function notesRelation($request)
    {
        $notes = new OrdernotesResourceCollection($this->notes);

        $notesLinks = [
            'links' => [
                'self' => route('orders.relationships.notes', ['notes' => $this->id]),
                'related' => route('orders.notes', ['notes' => $this->id]),
            ]
        ];

        return array_merge($notes->toArray($request), $notesLinks);
    }

}
