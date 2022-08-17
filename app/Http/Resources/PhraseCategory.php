<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PhraseCategory extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'                => $this->id,
            'name'              => json_decode($this->name),
            'slug'              => $this->slug,
            'color'             => $this->color,
            'icon_name'         => $this->icon_name,
            'icon_type'         => $this->icon_type,
            'image_url'         => $this->image_url,
            'phrases_count'     => $this->phrases_count,
        ];
    }
}
