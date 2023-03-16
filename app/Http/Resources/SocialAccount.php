<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SocialAccount extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                => $this->id,
            'social_id'         => $this->social_id,
            'social_name'       => $this->social_name,
            'social_photo_url'  => $this->social_photo_url,
            'social_provider'   => $this->social_provider,
        ];
    }
}
