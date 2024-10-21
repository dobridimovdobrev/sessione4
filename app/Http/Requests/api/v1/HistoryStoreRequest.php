<?php

namespace App\Http\Requests\api\v1;

use Illuminate\Foundation\Http\FormRequest;

class HistoryStoreRequest extends FormRequest
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
            'content_id' => 'required|integer',
            'content_type' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'nullable|date',
            'progress' => 'nullable|numeric|min:0|max:100',
            'user_id' => 'required|exists:users,user_id',
        ];
    }
}
