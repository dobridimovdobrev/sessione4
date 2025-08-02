<?php

namespace App\Http\Requests\api\v1;

use Illuminate\Foundation\Http\FormRequest;

class MovieStoreRequest extends FormRequest
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
            "title" => ['required', 'string', 'max:128'],
            "slug" => ['nullable', 'string', 'max:128'],
            "description" => ['required', 'string'],
            "year" => ['required', 'integer'],
            "duration" => ['nullable', 'integer'],
            "imdb_rating" => ['nullable', 'numeric', 'between: 0,10'],
            "premiere_date" => ['nullable', 'date'],
            "status" => ['required', 'in:published,draft,sheduled,coming soon'],
            "category_id" => ['required', 'exists:categories,category_id'],

            // Persons (conditionally validated if provided)
            'persons' => 'sometimes|array',
            'persons.*' => 'exists:persons,person_id',

            // Trailers (only validate if present)
            'trailers' => 'sometimes|array',
            'trailers.*.url' => 'sometimes|url',
            'trailers.*.' => 'sometimes|url',

            // Video files (only validate if present)
            'video_files' => 'sometimes|array',
            'video_files.*.url' => 'sometimes|url',

            // Image files (only validate if present)
            'image_files' => 'sometimes|array',
            'image_files.*.url' => 'sometimes|url',

        ];
    }
}
