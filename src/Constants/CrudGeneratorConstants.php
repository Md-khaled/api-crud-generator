<?php

namespace Khaled\ApiCrudGenerator\Constants;

class CrudGeneratorConstants
{
    // Configuration keys
    public const MODEL_NAMESPACE = 'crud-generator.model_namespace';
    public const CONTROLLER_NAMESPACE = 'crud-generator.controller_namespace';
    public const REQUEST_NAMESPACE = 'crud-generator.request_namespace';
    public const RESOURCE_NAMESPACE = 'crud-generator.resource_namespace';
    public const MIGRATION_PATH = 'crud-generator.migration_path';
    public const MODEL_PATH = 'crud-generator.model_path';
    public const CONTROLLER_PATH = 'crud-generator.controller_path';
    public const REQUEST_PATH = 'crud-generator.request_path';
    public const RESOURCE_PATH = 'crud-generator.resource_path';
    public const ROUTE_PATH = 'crud-generator.route_path';

    // Placeholder keys for stubs
    public const NAMESPACE_PLACEHOLDER = 'namespace';
    public const MODEL_NAME_PLACEHOLDER = 'modelName';
    public const MODEL_NAME_LOWER_PLACEHOLDER = 'modelNameLower';
    public const FILLABLE_FIELDS_PLACEHOLDER = 'fillableFields';
    public const VALIDATION_RULES_PLACEHOLDER = 'validationRules';
    public const TABLE_NAME_PLACEHOLDER = 'tableName';
    public const MIGRATION_COLUMNS_PLACEHOLDER = 'migrationColumns';
    public const MIGRATION_CLASS_NAME_PLACEHOLDER = 'className';
    public const RESOURCE_FIELDS_PLACEHOLDER = 'resourceFields';

    // Default field types for validation
    public const DEFAULT_FIELD_TYPES = [
        'string' => 'required|string|max:255',
        'integer' => 'required|integer',
        'text' => 'required|string',
    ];

    // Migration-related constants
    public const MIGRATION_FILE_PREFIX = 'create';
    public const MIGRATION_FILE_SUFFIX = '_table.php';
    public const DEFAULT_API_PREFIX = 'api';  // Default API route prefix
    public const DEFAULT_CONTROLLER_SUFFIX = 'Controller';
    public const ROUTE_NAME_PLACEHOLDER = 'routeName';
    public const ROUTE_CONTROLLER_PLACEHOLDER = 'controllerName';
}
