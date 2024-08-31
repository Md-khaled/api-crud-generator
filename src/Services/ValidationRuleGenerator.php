<?php

namespace Khaled\ApiCrudGenerator\Services;

use Khaled\ApiCrudGenerator\Constants\CrudGeneratorConstants;

class ValidationRuleGenerator
{
    /**
     * Generate validation rules for the given fields.
     *
     * @param array $fields
     * @return string
     */
    public function generateRules($fields)
    {
        $rules = [];
        foreach ($fields as $name => $type) {
            $rules[$name] = CrudGeneratorConstants::DEFAULT_FIELD_TYPES[$type] ?? 'required';
        }

        $rulesArray = [];
        foreach ($rules as $field => $rule) {
            $rulesArray[] = "'{$field}' => '{$rule}'";
        }

        return implode(",\n            ", $rulesArray);
    }
}
