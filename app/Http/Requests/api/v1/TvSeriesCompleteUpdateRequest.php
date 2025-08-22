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
        return [
            // Basic TV series data - use nullable for partial updates
            'title' => ['nullable', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:128'],
            'year' => ['nullable', 'integer'],
            'imdb_rating' => ['nullable', 'numeric', 'between:0,10'],
            'total_seasons' => ['nullable', 'integer'],
            'total_episodes' => ['nullable', 'integer'],
            'premiere_date' => ['nullable', 'date'],
            'status' => ['nullable', 'in:ongoing,ended,canceled,unknown,published,draft,upcoming'],
            'category_id' => ['nullable', 'exists:categories,category_id'],
            'description' => ['nullable', 'string'],

            // Image files (optional for updates)
            'poster_image' => 'nullable|file|mimes:jpg,jpeg,png,webp,gif|max:10240',
            'backdrop_image' => 'nullable|file|mimes:jpg,jpeg,png,webp,gif|max:10240',
    
            // Video file (optional)
            'trailer_video' => 'nullable|file|mimes:mp4,webm,ogg,mov,avi,mkv|max:512000',
            
            // Persons array (optional)
            'persons' => 'nullable|array',
            'persons.*' => 'exists:persons,person_id',

            // Trailers (optional)
            'trailers' => 'nullable|array',
            'trailers.*.url' => 'nullable|url',
            'trailers.*.title' => 'nullable|string|max:255',

            // Seasons (optional for updates)
            'seasons' => 'nullable|array',
            'seasons.*.season_number' => 'nullable|integer|min:1',
            'seasons.*.name' => 'nullable|string|max:255',
            'seasons.*.overview' => 'nullable|string',
            'seasons.*.year' => 'nullable|integer|min:1900|max:2100',
            'seasons.*.premiere_date' => 'nullable|date',

            // Episodes within seasons
            'seasons.*.episodes' => 'nullable|array',
            'seasons.*.episodes.*.title' => 'nullable|string|max:255',
            'seasons.*.episodes.*.description' => 'nullable|string',
            'seasons.*.episodes.*.episode_number' => 'nullable|integer|min:1',
            'seasons.*.episodes.*.duration' => 'nullable|integer|min:1',
            'seasons.*.episodes.*.air_date' => 'nullable|date',
            'seasons.*.episodes.*.status' => 'nullable|in:published,draft,upcoming',

            // Episode files (optional for updates)
            'seasons.*.episodes.*.episode_video' => 'nullable|file|mimes:mp4,webm,ogg,mov,avi,mkv|max:1024000',
            'seasons.*.episodes.*.still_image' => 'nullable|file|mimes:jpg,jpeg,png,webp,gif|max:10240',
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
            'seasons.array' => 'Seasons must be an array when provided.',
            'seasons.*.episodes.array' => 'Episodes must be an array when provided.',
        ];
    }
}
