<?php

namespace App\Http\Requests\api\v1;

use Illuminate\Foundation\Http\FormRequest;

class TvSeriesCompleteStoreRequest extends FormRequest
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
            'year' => ['required', 'integer'],
            'imdb_rating' => ['nullable', 'numeric', 'between:0,10'],
            'total_seasons' => ['nullable', 'integer'],
            'total_episodes' => ['nullable', 'integer'],
            'premiere_date' => ['nullable', 'date'],
            'status' => ['required', 'in:ongoing,ended,canceled,unknown'],
            'category_id' => ['required', 'exists:categories,category_id'],

            // Image URLs (required for complete creation - uploaded separately)
            'poster' => 'required|string|url',
            'backdrop' => 'required|string|url',
    
            // Video URL (optional - uploaded separately)
            'trailer_video_url' => 'nullable|string|url',
            
            // Persons (conditionally validated if provided)
            'persons' => 'sometimes|array',
            'persons.*' => 'exists:persons,person_id',

            // Trailers (only validate if present)
            'trailers' => 'sometimes|array',
            'trailers.*.url' => 'sometimes|url',
            'trailers.*.title' => 'sometimes|string',

            // Seasons with episodes
            'seasons' => 'required|array|min:1',
            'seasons.*.season_number' => 'required|integer',
            'seasons.*.total_episodes' => 'nullable|integer',
            'seasons.*.year' => 'required|integer',
            'seasons.*.premiere_date' => 'nullable|date',
            'seasons.*.name' => 'nullable|string|max:255',
            'seasons.*.overview' => 'nullable|string',

            // Episodes within seasons
            'seasons.*.episodes' => 'required|array|min:1',
            'seasons.*.episodes.*.title' => 'required|string|max:128',
            'seasons.*.episodes.*.slug' => 'nullable|string|max:128',
            'seasons.*.episodes.*.description' => 'nullable|string',
            'seasons.*.episodes.*.episode_number' => 'required|integer',
            'seasons.*.episodes.*.duration' => 'nullable|integer',
            'seasons.*.episodes.*.air_date' => 'nullable|date',
            'seasons.*.episodes.*.status' => 'required|in:published,draft,scheduled,coming soon',
            
            // Episode file URLs (required - uploaded separately)
            'seasons.*.episodes.*.episode_video' => 'required|string|url',
            'seasons.*.episodes.*.still_image' => 'required|string|url',
            
            // Episode persons (optional)
            'seasons.*.episodes.*.persons' => 'sometimes|array',
            'seasons.*.episodes.*.persons.*' => 'exists:persons,person_id',
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
            'seasons.required' => 'At least one season is required.',
            'seasons.*.episodes.required' => 'At least one episode is required for each season.',
            'seasons.*.episodes.*.episode_video.required' => 'Episode video is required for each episode.',
            'seasons.*.episodes.*.still_image.required' => 'Still image is required for each episode.',
        ];
    }
}
