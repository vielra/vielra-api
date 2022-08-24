<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePhraseAudioRequest extends FormRequest
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
        $voiceCodes = implode(",", config('app.phrase_voice_codes'));
        return [
            // 'phrase_id'     => ['required', 'string', 'exists:phrases,id'], // Don't need 
            'locale'        => ['required', 'string', 'in:vi,en,id'],
            'voice_code'    => ['required', 'string', "in:$voiceCodes"],
            'base64_audio'  => ['required', 'string'],
            'mime'          => ['required', 'string'],
        ];
    }
}
