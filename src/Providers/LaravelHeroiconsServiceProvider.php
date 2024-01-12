<?php

namespace CodeBros\LaravelHeroicons\Providers;

use Illuminate\Support\ServiceProvider;

class LaravelHeroiconsServiceProvider extends ServiceProvider
{
    public function register()
    {
//        for file in *.svg.blade.php
//do
//  sed -i 's/width="24" height="24"/{{ $attributes->merge(['class' => 'h-6 w-6']) }}/g' "$file"
//done
    }

    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'heroicons');
    }
}
