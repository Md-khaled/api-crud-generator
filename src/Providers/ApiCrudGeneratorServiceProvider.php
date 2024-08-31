<?php

namespace Khaled\ApiCrudGenerator\Providers;

use Illuminate\Support\ServiceProvider;
use Khaled\ApiCrudGenerator\Commands\MakeCrudCommand;

class ApiCrudGeneratorServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                MakeCrudCommand::class,
            ]);
        }
        $this->publishes([
            __DIR__ . '/../config/crud-generator.php' => config_path('crud-generator.php'),
        ]);
    }

    public function register()
    {
//        $this->mergeConfigFrom(__DIR__ . '/../../config/crud-generator.php', 'crud-generator');
    }
}
