<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'name'          => ['required', 'string'],
            'email'         => ['required', 'email', 'unique:users,email'],
            'username'      => ['nullable', 'unique:users,username'],
            'mobile_phone'  => ['nullable', 'unique:users,mobile_phone'],
            'password'      => ['required', 'confirmed'],
        ];
    }
}
