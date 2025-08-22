<?php

namespace App\Http\Requests\api\v1;

use Illuminate\Foundation\Http\FormRequest;

class MovieCompleteStoreRequest extends FormRequest
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
            // Basic movie data
            'title' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:128'],
            'year' => ['required', 'integer'],
            'duration' => ['nullable', 'integer'],
            'imdb_rating' => ['nullable', 'numeric', 'between:0,10'],
            'release_date' => ['nullable', 'date'],
            'status' => ['required', 'in:published,draft,scheduled,coming soon'],
            'category_id' => ['required', 'exists:categories,category_id'],
            'description' => ['nullable', 'string'],

            // Image files (required for complete creation)
            'poster_image' => 'required|file|image|max:10240', // 10MB max
            'backdrop_image' => 'required|file|image|max:10240', // 10MB max
    
            // Video files (optional)
            'trailer_video' => 'nullable|file|mimes:mp4,webm,ogg,mov,avi,mkv|max:512000', // 500MB max
            'movie_video' => 'nullable|file|mimes:mp4,webm,ogg,mov,avi,mkv|max:1024000', // 1GB max for full movies
            
            // Persons array (optional)
            'persons' => 'sometimes|array',
            'persons.*' => 'exists:persons,person_id',

            // Trailers (optional)
            'trailers' => 'sometimes|array',
            'trailers.*.url' => 'sometimes|url',
            'trailers.*.title' => 'sometimes|string',

            // Existing video IDs to keep (for updates)
            'existing_video_ids' => 'sometimes|array',
            'existing_video_ids.*' => 'integer|exists:video_files,video_file_id',
        ];
    }

    /**
     * Get custom messages for validator errors.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'poster_image.required' => 'Poster image is required.',
            'backdrop_image.required' => 'Backdrop image is required.',
            'title.required' => 'Movie title is required.',
            'year.required' => 'Release year is required.',
            'category_id.required' => 'Category is required.',
            'status.required' => 'Status is required.',
        ];
    }
}
