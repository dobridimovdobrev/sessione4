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
        
        // Apply update rules helper
        $updateRules = ValidationHelpers::updateRulesHelper($rules);
        
        // Fix password confirmation for updates - remove confirmed rule for optional updates
        if (isset($updateRules['password'])) {
            $updateRules['password'] = 'nullable|sometimes|string|min:8';
            // Add password_confirmation as optional field
            $updateRules['password_confirmation'] = 'nullable|sometimes|string|same:password';
        }
        
        return $updateRules;
    }
}
