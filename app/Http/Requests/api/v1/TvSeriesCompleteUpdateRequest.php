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
        
        // Custom validation for file uploads in updates - make them all optional
        $updatedRules['poster_image'] = 'nullable|file|mimes:jpg,jpeg,png,webp,gif|max:10240';
        $updatedRules['backdrop_image'] = 'nullable|file|mimes:jpg,jpeg,png,webp,gif|max:10240';
        $updatedRules['trailer_video'] = 'nullable|file|mimes:mp4,webm,ogg,mov|max:512000';
        
        // Make seasons optional for updates
        $updatedRules['seasons'] = 'sometimes|array';
        
        // Update nested episode file rules to be optional
        $updatedRules['seasons.*.episodes.*.episode_video'] = 'nullable|file|mimes:mp4,webm,ogg,mov,avi,mkv|max:1024000';
        $updatedRules['seasons.*.episodes.*.still_image'] = 'nullable|file|mimes:jpg,jpeg,png,webp,gif|max:10240';
        
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
