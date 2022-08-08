<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class LoginWithSocialAccountRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            // 'provider'          => ['required', 'string', 'in:google,facebook'],
            'social_id'         => ['required', 'string'],
            'social_name'       => ['required', 'string'],
            'social_email'      => ['required', 'string'],
            'social_photo_url'  => ['nullable', 'string'],
        ];
    }
}
