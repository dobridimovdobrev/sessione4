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
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'url' => 'required|url',
            'content_id' => 'required|integer',
            'content_type' => 'required|string|max:64',
            'format' => 'required|string|max:10',
            'size' => 'required|integer',
            'resolution' => 'nullable|string|max:10',
            'duration' => 'nullable|string',
        ];
    }
}
