<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::component('components.jet-label', 'jet-label');
    Blade::component('components.jet-input', 'jet-input');
    Blade::component('components.jet-button', 'jet-button');
    Blade::component('components.jet-input-error', 'jet-input-error');
    
    Blade::component('components.input-label', 'input-label');
    Blade::component('components.text-input', 'text-input');
    Blade::component('components.primary-button', 'primary-button');
    Blade::component('components.input-error', 'input-error');
    }
}
