<?php
namespace App\Helpers;

class ValidationHelpers
{
    /**
     * validation rules by replacing 'required' with 'sometimes'
     *
     * @param array $rules
     * @return array
     */

    public static function updateRulesHelper($rules)
    {
        $newRules = [];
        // replacing 'required' with 'sometimes' - DO NOT add nullable automatically
        foreach($rules as $key => $value){
            if (is_array($value)) {
                // Handle array format rules like ['required', 'string', 'max:128']
                $newRules[$key] = array_map(function($rule) {
                    return $rule === 'required' ? 'sometimes' : $rule;
                }, $value);
            } else {
                // Handle string format rules like 'required|string|url'
                $newRules[$key] = str_replace('required', 'sometimes', $value);
            }
        }

        return $newRules;
    }



}