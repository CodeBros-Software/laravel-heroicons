<?php

namespace CodeBros\LaravelHeroicons\Providers;

use Illuminate\Support\ServiceProvider;

class LaravelHeroiconsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function boot(): void
    {
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'heroicons');
    }
}
