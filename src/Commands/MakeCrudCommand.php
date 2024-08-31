<?php

namespace Khaled\ApiCrudGenerator\Commands;

use Illuminate\Console\Command;
use Khaled\ApiCrudGenerator\Services\CrudGeneratorService;

class MakeCrudCommand extends Command
{
    protected $signature = 'make:crud {name} {fields?}';
    protected $description = 'Generate CRUD operations for a model';

    protected $crudService;

    public function __construct(CrudGeneratorService $crudService)
    {
        parent::__construct();
        $this->crudService = $crudService;
    }

    public function handle()
    {
        $name = $this->argument('name');
        $fields = $this->parseFields($this->argument('fields'));

        $this->crudService->generateModel($name, $fields);
        $this->crudService->generateController($name);
        $this->crudService->generateRequest($name, $fields);
        $this->crudService->generateResource($name, $fields);
        $this->crudService->generateMigration($name, $fields);
        $this->crudService->generateRoutes($name);

        $this->info('CRUD operations generated successfully.');
    }

    protected function parseFields($fields)
    {
        if (!$fields) {
            return [];
        }

        $fieldsArray = explode(',', $fields);
        $fields = [];
        foreach ($fieldsArray as $field) {
            list($name, $type) = explode(':', $field);
            $fields[trim($name)] = trim($type);
        }

        return $fields;
    }
}
