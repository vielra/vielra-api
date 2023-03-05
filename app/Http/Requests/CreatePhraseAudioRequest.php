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
        return [
            'phrase_id'         => ['required', 'string'],
            'speech_name_id'    => ['nullable', 'integer'],
            'locale'            => ['required', 'string', 'in:vi,en,id'],
            'audio_file'        => ['required', 'file'],
        ];
    }
}
