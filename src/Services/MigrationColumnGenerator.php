<?php

namespace Khaled\ApiCrudGenerator\Services;

class MigrationColumnGenerator
{
    public function generateColumns($fields)
    {
        if (empty($fields)) {
            return ''; // No columns if no fields are specified
        }

        $columns = [];
        foreach ($fields as $field => $type) {
            if ($type === 'integer') {
                $columns[] = "\$table->integer('$field');";
            } elseif ($type === 'string') {
                $columns[] = "\$table->string('$field');";
            } elseif ($type === 'text') {
                $columns[] = "\$table->text('$field');";
            }
            // Add more field type migrations as needed
        }

        return implode("\n            ", $columns);
    }
}
