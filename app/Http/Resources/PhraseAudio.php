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
            'id'            => $this->id,
            'audio_url'     => $this->audio_url
                ? URL::to('/storage/phrasebook/audios/' . $this->audio_url)
                : null,
            'mime'          => $this->mime,
            'locale'        => $this->locale,
            'voice_code'    => $this->voice_code,
            'user_id'       => $this->user_id,
            'created_at'    => $this->created_at,
        ];
    }
}
