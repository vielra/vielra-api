<?php

namespace Modules\Common\Http\Requests;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


abstract class BaseFormRequest extends FormRequest
{

  /**
   * Available attributes.
   *
   * @var string
   */
  protected $availableAttributes = '';

  /**
   * Current processed locale.
   *
   * @var string
   */
  protected $localeKey;

  /** 
   * Determine if the user is authorized to make this request.
   */
  public function authorize(): bool
  {
    return true;
  }


  /**
   * Get custom attributes for validator errors.
   *
   * @return array
   */
  public function attributes(): array
  {
    $attributes = trans($this->availableAttributes) ?: [];

    if (!is_array($attributes)) {
      return [];
    }

    return array_map('mb_strtolower', array_dot($attributes));
  }

  /**
   * Get custom messages for validator errors.
   *
   * @return array
   */
  public function messages(): array
  {
    $attributesAndRules = $this->parseRules($this->rules());

    $messages = [];

    foreach ($attributesAndRules as $attributeAndRule) {
      $rule = last(explode('.', $attributeAndRule));

      $messages[$attributeAndRule] = trans("validation.{$rule}");
    }

    return $messages;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
   */
  public function rules(): array
  {
    return [
      //
    ];
  }

  /**
   * Parse rules for the given attributes.
   *
   * Gives
   * [
   *  'name' => 'required|size:60',
   * ]
   *
   * Returns
   * [
   *  'name.required',
   *  'name.size',
   * ]
   *
   * @param array $rules
   *
   * @return array
   */
  protected function parseRules(array $rules): array
  {
    $attributesAndRules = [];

    foreach ($rules as $attribute => $rulesList) {
      if (!is_array($rulesList)) {
        $rulesList = explode('|', $rulesList);
      }

      foreach ($rulesList as $rule) {
        if ($rule instanceof Closure || $rule instanceof Rule || $rule instanceof ValidationRule) {
          continue;
        }

        if (str_contains($rule, ':')) {
          [$rule] = explode(':', $rule, 2);
        }

        $attributesAndRules[] = "{$attribute}.{$rule}";
      }
    }

    return $attributesAndRules;
  }
}
