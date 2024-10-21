<?php

namespace App\Http\Requests\api\v1;

use Illuminate\Foundation\Http\FormRequest;

class TvSeriesStoreRequest extends FormRequest
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
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'year' => ['required', 'integer'],
            'duration' => ['nullable', 'integer'],
            'imdb_rating' => ['nullable', 'numeric', 'between:0,10'],
            'total_seasons' => ['nullable', 'integer'],
            'premiere_date' => ['nullable', 'date'],
            'status' => ['required', 'in:published,draft,coming soon'],
            'category_id' => ['required', 'exists:categories,category_id'],
        ];
    }
}
