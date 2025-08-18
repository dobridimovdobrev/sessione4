<?php

namespace App\Http\Requests\api\v1;

use Illuminate\Foundation\Http\FormRequest;

class UserStoreRequest extends FormRequest
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
            'username' => 'required|string|max:64|unique:users,username',
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',  
            'first_name' => 'required|string|max:64',
            'last_name' => 'required|string|max:64',
            'gender' => 'required|in:male,female',
            'birthday' => 'required|date',
            'country_id' => 'nullable|exists:countries,country_id',
            'user_status' => 'nullable|in:active,inactive,banned',
            'role_id' => 'nullable|exists:roles,role_id'
        ];
    }
}
