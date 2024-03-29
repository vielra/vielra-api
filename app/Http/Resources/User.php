<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\URL;

class User extends JsonResource
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
            'name'          => $this->name,
            'email'         => $this->email,
            'username'      => $this->username,
            'photo_url'     => $this->photo_url !== null
                ? URL::to("/storage/images/users/$this->user-id") . $this->photo_url
                : null,
            'gender'        => $this->gender,
            'mobile_phone'  => $this->mobile_phone,
            'birthday'      => $this->birthday,
            'about'         => $this->about,
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at,
            'status'        => $this->status,
            'social_account' => new SocialAccount($this->whenLoaded('social_account')),
        ];
    }
}
