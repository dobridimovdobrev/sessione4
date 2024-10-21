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
            'season_id' => 'required|exists:seasons,season_id',
            'title' => 'required|string|max:64',
            'description' => 'required|string',
            'episode_number' => 'required|integer',
            'duration' => 'required|integer',
            'status' => 'required|in:published,draft,scheduled,coming soon',
        ];
    }
}
