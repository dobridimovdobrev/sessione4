<?php

namespace App\Http\Requests\api\v1;

use Illuminate\Foundation\Http\FormRequest;

class EpisodeStoreRequest extends FormRequest
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
            // Basic episode data
            'season_id' => 'required|exists:seasons,season_id',
            'title' => 'required|string|max:128',
            'slug' => 'nullable|string|max:128',
            'description' => 'nullable|string',
            'episode_number' => 'required|integer',
            'duration' => 'nullable|integer',
            'air_date' => 'nullable|date',
            'status' => 'required|in:published,draft,scheduled,coming soon',

            // File uploads (required for episodes)
            'episode_video' => 'required|file|mimes:mp4,webm,ogg,mov,avi,mkv|max:1024000', // 1GB max for episodes
            'still_image' => 'required|file|mimes:jpg,jpeg,png,webp,gif|max:10240', // 10MB max for images

            // Optional fields
            'persons' => 'sometimes|array',
            'persons.*' => 'exists:persons,person_id',
        ];
    }
}
