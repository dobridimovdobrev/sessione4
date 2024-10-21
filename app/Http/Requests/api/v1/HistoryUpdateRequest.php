<?php

namespace App\Http\Requests\api\v1;

use App\Helpers\ValidationHelpers;


class HistoryUpdateRequest extends HistoryStoreRequest
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
