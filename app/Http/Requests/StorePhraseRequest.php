<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePhraseRequest extends FormRequest
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
            'text_vi'                   => ['required', 'string'],
            'text_en'                   => ['string', 'nullable'],
            'text_id'                   => ['string', 'nullable'],
            'confirmed'                 => ['nullable', 'boolean'],
            'mark_as_created_by_system' => ['nullable', 'boolean'],
            'order'                     => ['nullable', 'integer'],
            'category_ids'              => ['array', 'nullable'],
            'category_ids.*'            => ['exists:phrase_categories,id', 'string'],
        ];
    }
}
