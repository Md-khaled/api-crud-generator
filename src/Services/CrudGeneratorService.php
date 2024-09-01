<?php

namespace Khaled\ApiCrudGenerator\Services;

use Illuminate\Support\Str;
use Khaled\ApiCrudGenerator\Constants\CrudGeneratorConstants;
use Khaled\ApiCrudGenerator\Helpers\CrudHelper;

class CrudGeneratorService
{
    public function generateModel($name, $fields)
    {
        $namespace = CrudHelper::getNamespace(CrudGeneratorConstants::MODEL_NAMESPACE);
        $path = CrudHelper::getPath(CrudGeneratorConstants::MODEL_PATH);
        $fillableFields = empty($fields) ? '' : implode("', '", array_keys($fields));

        $modelContent = CrudHelper::getStubContent('Model', [
            CrudGeneratorConstants::NAMESPACE_PLACEHOLDER => $namespace,
            CrudGeneratorConstants::MODEL_NAME_PLACEHOLDER => $name,
            CrudGeneratorConstants::FILLABLE_FIELDS_PLACEHOLDER => $fillableFields
        ]);
        CrudHelper::writeFile("$path/{$name}.php", $modelContent);
        dd("$path/{$name}.php", $modelContent);
    }

    public function generateController($name)
    {
        $namespace = CrudHelper::getNamespace(CrudGeneratorConstants::CONTROLLER_NAMESPACE);
        $path = CrudHelper::getPath(CrudGeneratorConstants::CONTROLLER_PATH);

        $controllerContent = CrudHelper::getStubContent('Controller', [
            CrudGeneratorConstants::NAMESPACE_PLACEHOLDER => $namespace,
            CrudGeneratorConstants::MODEL_NAME_PLACEHOLDER => $name,
            CrudGeneratorConstants::MODEL_NAME_LOWER_PLACEHOLDER => strtolower($name)
        ]);

        CrudHelper::writeFile("$path/{$name}" . CrudGeneratorConstants::DEFAULT_CONTROLLER_SUFFIX . ".php", $controllerContent);
    }

    public function generateRequest($name, $fields)
    {
        $namespace = CrudHelper::getNamespace(CrudGeneratorConstants::REQUEST_NAMESPACE);
        $path = CrudHelper::getPath(CrudGeneratorConstants::REQUEST_PATH);
        $validationRules = (new ValidationRuleGenerator())->generateRules($fields);

        $requestContent = CrudHelper::getStubContent('Request', [
            CrudGeneratorConstants::NAMESPACE_PLACEHOLDER => $namespace,
            CrudGeneratorConstants::MODEL_NAME_PLACEHOLDER => $name,
            CrudGeneratorConstants::VALIDATION_RULES_PLACEHOLDER => $validationRules
        ]);

        CrudHelper::writeFile("$path/{$name}Request.php", $requestContent);
    }

    public function generateResource($name, $fields)
    {
        $namespace = CrudHelper::getNamespace(CrudGeneratorConstants::RESOURCE_NAMESPACE);
        $path = CrudHelper::getPath(CrudGeneratorConstants::RESOURCE_PATH);

        $resourceFields = [];
        foreach ($fields as $field => $type) {
            $resourceFields[] = "'{$field}' => \$this->{$field}";
        }
        $resourceFieldsString = implode(",\n            ", $resourceFields);

        $resourceContent = CrudHelper::getStubContent('Resource', [
            CrudGeneratorConstants::NAMESPACE_PLACEHOLDER => $namespace,
            CrudGeneratorConstants::MODEL_NAME_PLACEHOLDER => "{$name}Resource",
            CrudGeneratorConstants::RESOURCE_FIELDS_PLACEHOLDER => $resourceFieldsString
        ]);

        CrudHelper::writeFile("$path/{$name}Resource.php", $resourceContent);
    }

    public function generateMigration($name, $fields)
    {
        $tableName = Str::snake(Str::pluralStudly($name));
        $migrationFile = CrudHelper::generateMigrationFilePath($tableName);

        $migrationColumns = (new MigrationColumnGenerator())->generateColumns($fields);

        $migrationContent = CrudHelper::getStubContent('Migration', [
            CrudGeneratorConstants::NAMESPACE_PLACEHOLDER => 'Database\\Migrations',
            CrudGeneratorConstants::TABLE_NAME_PLACEHOLDER => $tableName,
            CrudGeneratorConstants::MIGRATION_COLUMNS_PLACEHOLDER => $migrationColumns,
            CrudGeneratorConstants::MIGRATION_CLASS_NAME_PLACEHOLDER => "Create" . Str::studly($tableName) . "Table"
        ]);

        CrudHelper::writeFile($migrationFile, $migrationContent);
    }

    public function generateRoutes($name)
    {
        $routesPath = base_path('routes/api.php');
        $controllerName = $name . CrudGeneratorConstants::DEFAULT_CONTROLLER_SUFFIX;

        $routesContent = CrudHelper::getStubContent('Routes', [
            CrudGeneratorConstants::ROUTE_NAME_PLACEHOLDER => strtolower(Str::plural($name)),
            CrudGeneratorConstants::ROUTE_CONTROLLER_PLACEHOLDER => $controllerName
        ]);
        dd($routesContent);

        file_put_contents($routesPath, $routesContent, FILE_APPEND);
    }
}
