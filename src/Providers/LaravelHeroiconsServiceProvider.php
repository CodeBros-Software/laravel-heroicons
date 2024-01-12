<?php

namespace CodeBros\LaravelHeroicons\Providers;

use Illuminate\Support\ServiceProvider;

class LaravelHeroiconsServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'heroicons');
    }
}
