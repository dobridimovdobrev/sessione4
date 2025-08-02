<?php

namespace App\Http\Requests\api\v1;

use Illuminate\Foundation\Http\FormRequest;

class VideoFileStoreRequest extends FormRequest
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
        // Check if we're uploading a file or using a URL
        if ($this->hasFile('video')) {
            return [
                'video' => 'required|file|mimes:mp4,webm,ogg,mov,avi,mkv|max:512000', // Max 500MB
                'title' => 'required|string|max:255',
            ];
        }

        // Default rules for URL-based videos
        return [
            'title' => 'required|string|max:255',
            'url' => 'required_without:video|url',
            'format' => 'required|string|max:10',
            'resolution' => 'required|string|max:10',
        ];
    }
}
