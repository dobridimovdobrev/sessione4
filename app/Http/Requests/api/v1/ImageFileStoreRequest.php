<?php

namespace App\Http\Requests\api\v1;

use Illuminate\Foundation\Http\FormRequest;

class ImageFileStoreRequest extends FormRequest
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
        if ($this->hasFile('image')) {
            return [
                'image' => 'required|file|mimes:jpg,jpeg,png,webp,gif|max:10240', // Max 10MB
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'type' => 'required|string|in:poster,backdrop,still,persons',
            ];
        }

        // Default rules for URL-based images
        return [
            'url' => 'required_without:image|url',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'format' => 'required|string|max:10',
            'type' => 'required|string|in:poster,backdrop,still,persons',
        ];
    }
}
