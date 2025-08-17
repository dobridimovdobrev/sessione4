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
        // replacing 'required' with 'sometimes' and adding 'nullable' for optional fields
        foreach($rules as $key => $value){
            if (is_array($value)) {
                // Handle array format rules like ['required', 'string', 'max:128']
                $newRules[$key] = array_map(function($rule) {
                    return $rule === 'required' ? 'sometimes' : $rule;
                }, $value);
                // Add nullable for optional fields
                if (!in_array('nullable', $newRules[$key])) {
                    array_unshift($newRules[$key], 'nullable');
                }
            } else {
                // Handle string format rules like 'required|string|url'
                $newRules[$key] = str_replace('required', 'sometimes', $value);
                // Add nullable for optional fields
                if (strpos($newRules[$key], 'nullable') === false) {
                    $newRules[$key] = 'nullable|' . $newRules[$key];
                }
            }
        }

        return $newRules;
    }



}