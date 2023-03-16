<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PhraseCategory extends JsonResource
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
            'name'              => json_decode($this->name),
            'slug'              => $this->slug,
            'color'             => $this->color,
            'mobile_icon'       => $this->mobile_icon,
            'mobile_icon_type'  => $this->mobile_icon_type,
            'web_icon'          => $this->web_icon,
            'image_url'         => $this->image_url,
            'order'             => $this->order,
            'is_active'         => $this->is_active,
            'phrases_count'     => $this->phrases_count,
        ];
    }
}
