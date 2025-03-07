<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class DelightResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $gourmet = Auth::user();
        $isFollowing = $gourmet ? $gourmet->isTasting($this->gourmet) : false;

        return [
            'id' => $this->id,
            'title' => $this->title,
            'content' => $this->content,
            'gourmet' => new GourmetResource($this->whenLoaded('gourmet')),
            'nibbles_count' => $this->nibbles()->count(),
            'eats_count' => $this->eats()->count(),
            'is_eaten' => $this->when($gourmet && $isFollowing && !$this->public, $this->isEatenBy($gourmet->id), false),
            'public' => $this->public,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
