<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;

class PhraseAudio extends JsonResource
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
            'audio_url'         => $this->audio_url ? URL::to('/storage' . $this->audio_url) : null,
            'locale'            => $this->locale,
            'user_id'           => $this->user_id,
            'phrase_id'         => $this->phrase_id,
            'speech_name_id'    => $this->speech_name_id,
            'speech_name'       => new SpeechName($this->whenLoaded('speech_name')),
            'mime_type'         => $this->mime_type,
            'created_at'        => $this->created_at,
        ];
    }
}
