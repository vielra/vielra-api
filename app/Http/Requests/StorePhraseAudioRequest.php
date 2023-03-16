<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePhraseAudioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'phrase_id'         => ['required', 'string'],
            'speech_name_id'    => ['nullable', 'integer'],
            'locale'            => ['required', 'string', 'in:vi,en,id'],
            'audio_file'        => ['required', 'file'],
        ];
    }
}
