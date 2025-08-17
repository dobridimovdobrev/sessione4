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
       
       // Apply general update transformations (required -> sometimes)
       $updatedRules = ValidationHelpers::updateRulesHelper($rules);
       
       // Custom validation for poster and backdrop in updates
       // Allow null, empty string, or valid URLs
       $updatedRules['poster'] = [
           'nullable',
           'string',
           function ($attribute, $value, $fail) {
               if (!empty($value) && !filter_var($value, FILTER_VALIDATE_URL)) {
                   $fail("The {$attribute} field must be a valid URL when provided.");
               }
           }
       ];
       
       $updatedRules['backdrop'] = [
           'nullable', 
           'string',
           function ($attribute, $value, $fail) {
               if (!empty($value) && !filter_var($value, FILTER_VALIDATE_URL)) {
                   $fail("The {$attribute} field must be a valid URL when provided.");
               }
           }
       ];

       return $updatedRules;
    }
}
