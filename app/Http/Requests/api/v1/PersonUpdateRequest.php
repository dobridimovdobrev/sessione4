<?php

namespace App\Http\Requests\api\v1;

use App\Helpers\ValidationHelpers;


class PersonUpdateRequest extends PersonStoreRequest
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
        $updatedRules = ValidationHelpers::updateRulesHelper($rules);
        
        // Keep image_file_id as nullable for updates
        $updatedRules['image_file_id'] = 'nullable|exists:image_files,image_id';
        
        return $updatedRules;
    }
}
