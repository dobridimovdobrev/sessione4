<?php

namespace App\Http\Requests\api\v1;

use App\Helpers\ValidationHelpers;
use Illuminate\Support\Facades\Auth;

class UserUpdateRequest extends UserStoreRequest
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

        //authenticated user
        $user = Auth::user();
        
        if ($user) {
           
            $rules['username'] = 'required|string|max:64|unique:users,username,' . $user->user_id; 
        }
        return ValidationHelpers::updateRulesHelper($rules);
    }
}
