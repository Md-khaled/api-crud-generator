<?php

namespace Khaled\ApiCrudGenerator;

use Illuminate\Support\ServiceProvider;

class TestApiServiceProvider extends ServiceProvider
{
    public function boot()
    {
        dd('its working tt');
    }

    public function register()
    {
    }
}
