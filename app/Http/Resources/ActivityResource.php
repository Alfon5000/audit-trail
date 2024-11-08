<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ActivityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'causer' => $this->causer,
            'menu' => class_basename($this->subject),
            'method' => $this->event,
            'changes' => $this->changes,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
        ];
    }
}
