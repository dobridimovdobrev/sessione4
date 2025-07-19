<?php

namespace App\Http\Requests\api\v1;

use Illuminate\Foundation\Http\FormRequest;

class SeasonStoreRequest extends FormRequest
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
           'season_number' => 'required|integer',
            'total_episodes' => 'required|integer',
            'year' => 'required|integer',
            'premiere_date' => 'nullable|date',
            'tv_series_id' => 'required|exists:tv_series,tv_series_id',
        ];
    }
}
