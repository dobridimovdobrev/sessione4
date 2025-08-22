<?php

namespace App\Http\Requests\api\v1;

use App\Helpers\ValidationHelpers;

class TvSeriesCompleteUpdateRequest extends TvSeriesCompleteStoreRequest
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
        
        return $updatedRules;
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'seasons.array' => 'Seasons must be an array when provided.',
            'seasons.*.episodes.array' => 'Episodes must be an array when provided.',
        ];
    }
}
