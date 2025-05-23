<?php

namespace Modules\Common\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BasePaginateRequest extends FormRequest
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
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array
  {
    return [
      'paginate'  => ['nullable', 'boolean'],
      'page'      => ['numeric', 'min:1'],
      'perPage'   => ['numeric', 'min:1'],
    ];
  }

  /**
   * Get the error messages for the defined validation rules.
   *
   * @return array<string, string>
   */
  public function messages()
  {
    return [
      'paginate.boolean' => 'paginate field must be 1 or 0.'
    ];
  }
}
