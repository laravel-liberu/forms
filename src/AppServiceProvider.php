<?php

namespace LaravelLiberu\Forms;

use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/forms.php', 'liberu.forms');

        $this->publishes([
            __DIR__.'/../config' => config_path('liberu'),
        ], ['forms-config', 'liberu-config']);

        Collection::wrap(['Forms/Builders/ModelForm', 'Forms/Templates/template'])
            ->each(fn ($stub) => $this->publishes([
                __DIR__."/../stubs/{$stub}.stub" => app_path("{$stub}.php"),
            ], 'forms-resources'));
    }
}
