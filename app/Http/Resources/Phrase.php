<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Phrase extends JsonResource
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
            'status_id'         => $this->status_id,
            'order'             => $this->order,
            'text'              => [
                'vi'            => $this->text_vi,
                'en'            => $this->text_en,
                'id'            => $this->text_id,
            ],
            'audios'            => new PhraseAudioCollection($this->whenLoaded('audios')),
        ];
    }
}
