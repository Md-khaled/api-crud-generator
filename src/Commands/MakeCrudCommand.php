<?php

namespace Khaled\ApiCrudGenerator\Commands;

use Illuminate\Console\Command;
use Khaled\ApiCrudGenerator\Services\CrudGeneratorService;
use Illuminate\Support\Facades\File;
class MakeCrudCommand extends Command
{
    protected $signature = 'make:crud {name}';
    protected $description = 'Generate CRUD for a given model name';

    public function handle()
    {
        $name = $this->argument('name');
        $this->generateModel($name);
        $this->generateController($name);
        $this->generateRequest($name);
        $this->generateMigration($name);
        $this->appendRoutes($name);
        $this->info("CRUD for {$name} generated successfully.");
    }

    protected function generateModel($name)
    {
        $stub = File::get(__DIR__.'/../Stubs/model.stub');
        $stub = str_replace('{{modelName}}', $name, $stub);
        File::put(app_path("/Models/{$name}.php"), $stub);
    }

    protected function generateController($name)
    {
        $stub = File::get(__DIR__.'/../Stubs/controller.stub');
        $stub = str_replace('{{modelName}}', $name, $stub);
        $stub = str_replace('{{modelVariable}}', strtolower($name), $stub);
        File::put(app_path("/Http/Controllers/{$name}Controller.php"), $stub);
    }

    protected function generateRequest($name)
    {
        $stub = File::get(__DIR__.'/../Stubs/request.stub');
        $stub = str_replace('{{modelName}}', $name, $stub);
        File::put(app_path("/Http/Requests/{$name}Request.php"), $stub);
    }

    protected function generateMigration($name)
    {
        $tableName = strtolower($name.'s');
        $timestamp = date('Y_m_d_His');
        $stub = File::get(__DIR__.'/../Stubs/migration.stub');
        $stub = str_replace('{{tableName}}', $tableName, $stub);
        File::put(database_path("/migrations/{$timestamp}_create_{$tableName}_table.php"), $stub);
    }

    protected function appendRoutes($name)
    {
        $stub = File::get(__DIR__.'/../Stubs/routes.stub');
        $stub = str_replace('{{modelName}}', $name, $stub);
        $stub = str_replace('{{modelVariable}}', strtolower($name), $stub);
        File::append(base_path('routes/api.php'), $stub);
    }
}
