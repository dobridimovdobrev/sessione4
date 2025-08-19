<?php

namespace App\Http\Requests\api\v1;

use App\Helpers\ValidationHelpers;


class EpisodeUpdateRequest extends EpisodeStoreRequest
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
        
        // Make file uploads optional for updates (partial updates)
        $updatedRules['episode_video'] = 'nullable|file|mimes:mp4,webm,ogg,mov,avi,mkv|max:1024000';
        $updatedRules['still_image'] = 'nullable|file|mimes:jpg,jpeg,png,webp,gif|max:10240';

        return $updatedRules;
    }
}
