<?php

namespace App\Http\Resources;


use Illuminate\Http\Resources\Json\JsonResource;

class ContactResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'created_at' => $this->created_at->format('d.m.Y'),
            'author' => $this->author->name,
            'phones' => PhoneResource::collection($this->phones),
        ];
    }
}
