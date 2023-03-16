<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Phrase extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'                    => $this->id,
            'status_id'             => $this->status_id,
            'order'                 => $this->order,
            'text'                  => [
                'vi'                => $this->text_vi,
                'en'                => $this->text_en,
                'id'                => $this->text_id,
            ],
            'audios'                => new PhraseAudioCollection($this->whenLoaded('audios')),
            'has_reported'          => $this->has_reported,
            'user_id'               => $this->user_id,
            'confirmed'             => $this->confirmed,
            'confirmed_by_user_id'  => $this->confirmed_by_user_id,
        ];
    }
}
