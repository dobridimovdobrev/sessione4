<?php

namespace App\Http\Requests\api\v1;

use App\Helpers\ValidationHelpers;

class MovieUpdateRequest extends MovieStoreRequest
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
       
       // Remove URL validation for poster and backdrop in updates
       // Frontend might send empty strings or invalid values
       unset($rules['poster']);
       unset($rules['backdrop']);
       
       // Apply general update transformations to remaining rules
       $updatedRules = ValidationHelpers::updateRulesHelper($rules);
       
       // Add back poster and backdrop as completely optional
       $updatedRules['poster'] = 'nullable|string';
       $updatedRules['backdrop'] = 'nullable|string';

       return $updatedRules;
    }
}
