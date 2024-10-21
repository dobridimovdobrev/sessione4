<?php

namespace App\Http\Requests\api\v1;

use Illuminate\Foundation\Http\FormRequest;

class CountryStoreRequest extends FormRequest
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
            "name" => 'required|string|max:64' ,
            "continent" => 'required|string|max:5',
            "iso_char2" => 'required|string|max:2',
            "iso_char3" => 'required|string|max:3',
            "phone_prefix" => 'required|string|max:5'
        ];
    }
}


