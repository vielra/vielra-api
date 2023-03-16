<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PhraseReport extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'user_id'       => $this->user_id,
            'phrase_id'     => $this->phrase_id,
            'report_type'   => $this->report_type,
            'body'          => $this->body,
            'created_at'    => $this->created_at,
        ];
    }
}
