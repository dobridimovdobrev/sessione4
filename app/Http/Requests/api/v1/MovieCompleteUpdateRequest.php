<?php

namespace App\Http\Requests\api\v1;

use App\Helpers\ValidationHelpers;

class MovieCompleteUpdateRequest extends MovieCompleteStoreRequest
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
            'poster_image.file' => 'Poster must be a valid image file when provided.',
            'backdrop_image.file' => 'Backdrop must be a valid image file when provided.',
            'trailer_video.file' => 'Trailer must be a valid video file when provided.',
            'movie_video.file' => 'Movie video must be a valid video file when provided.',
        ];
    }
}
