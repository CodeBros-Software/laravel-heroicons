# Heroicons for Laravel

Heroicons for Laravel is an elegant Laravel package that enables developers to effortlessly integrate [Heroicons](https://heroicons.com/) into their Laravel applications using Blade components. This package provides a convenient and efficient way to utilize Heroicons' beautifully designed icons in your web projects.

## Prerequisites

This package assumes that you are using Tailwind CSS in your Laravel project, as Heroicons are primarily designed to complement Tailwind's utility-first approach. Please ensure that Tailwind CSS is properly set up in your project environment.

## Features

* Easy Integration: Seamlessly integrates with Laravel projects.
* Blade Components: Leverage Laravel Blade components for easy icon insertion.
* Full Heroicons Library: Access to the complete Heroicons collection.

## Installation

Install the package via Composer:
```bash
composer require codebros/laravel-heroicons
```
Publish the assets (optional):
```bash
php artisan vendor:publish --provider="CodeBros\LaravelHeroicons\Providers\LaravelHeroiconsServiceProvider"
```

## Usage

Using Heroicons in your Laravel views is simple:

```blade
<x-heroicons::outline.bolt class="w-6 h-6 text-green-500" />
```
Replace `outline.bolt` with the desired Heroicon style and name. Add your own class attributes for size and color customization.

## Contribution

Contributions are welcome! Please follow the standard Laravel contribution guidelines.

## License

This package is open-sourced software licensed under the MIT license.
