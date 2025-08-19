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
            // Basic TV series data
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:128'],
            'description' => ['required', 'string'],
            'year' => ['required', 'integer'],
            'imdb_rating' => ['nullable', 'numeric', 'between:0,10'],
            'total_seasons' => ['nullable', 'integer'],
            'total_episodes' => ['nullable', 'integer'],
            'premiere_date' => ['nullable', 'date'],
            'status' => ['required', 'in:ongoing,ended,canceled,unknown'],
            'category_id' => ['required', 'exists:categories,category_id'],

            // Image URLs (required for store, optional for update)
            'poster' => 'required|string|url',
            'backdrop' => 'required|string|url',
    
            // Video files (optional)
            'trailer_video' => 'nullable|file|mimes:mp4,webm,ogg,mov|max:512000',
            
            // Persons (conditionally validated if provided)
            'persons' => 'sometimes|array',
            'persons.*' => 'exists:persons,person_id',

            // Trailers (only validate if present)
            'trailers' => 'sometimes|array',
            'trailers.*.url' => 'sometimes|url',
            'trailers.*.title' => 'sometimes|string',

            // Image files (only validate if present)
            'image_files' => 'sometimes|array',
            'image_files.*.url' => 'sometimes|url',
        ];
    }
}
