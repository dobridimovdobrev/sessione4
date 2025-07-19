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
        // replacing 'required' with 'sometimes'
        foreach($rules as $key => $value){
            $newRules[$key] = str_replace('required', 'sometimes', $value);
        }

        return $newRules;
    }



}