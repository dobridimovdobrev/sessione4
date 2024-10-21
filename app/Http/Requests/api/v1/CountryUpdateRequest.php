<?php

namespace App\Http\Requests\api\v1;

use App\Helpers\ValidationHelpers;
use App\Http\Requests\api\v1\CountryStoreRequest;

class CountryUpdateRequest extends CountryStoreRequest
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
         $rules = parent::rules();
         return ValidationHelpers::updateRulesHelper($rules);
    }
}
