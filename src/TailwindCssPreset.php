<?php

namespace StatamicFrontendPresets\TailwindCssPreset;

use Illuminate\Support\Arr;
use Illuminate\Container\Container;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Console\Presets\Preset;

class TailwindCssPreset extends Preset
{
    static $clean = false;

    public static function install()
    {
        static::updatePackages();
        static::updateStyles();
        static::updateBootstrapping();
        static::updateWelcomePage();
        static::removeNodeModules();
    }

    public static function installClean()
    {
        self::$clean = true;
        static::install();
    }

    protected static function updatePackageArray(array $packages)
    {
        if (self::$clean) {
            return [
                'laravel-mix' => '^4.0',
                'laravel-mix-purgecss' => '^4.0.0',
                'laravel-mix-tailwind' => '^0.1.0',
            ];
        }

        return array_merge([
            'laravel-mix' => '^4.0',
            'laravel-mix-purgecss' => '^4.0.0',
            'laravel-mix-tailwind' => '^0.1.0',
        ], Arr::except($packages, [
            'axios',
            'bootstrap',
            'bootstrap-sass',
            'laravel-mix',
            'jquery',
            'popper',
            'vue'
        ]));
    }

    protected static function updateStyles()
    {
        tap(new Filesystem, function ($filesystem) {
            $filesystem->deleteDirectory(resource_path('sass'));
            $filesystem->delete(public_path('js/site.js'));
            $filesystem->delete(public_path('css/site.css'));

            if (! $filesystem->isDirectory($directory = resource_path('css'))) {
                $filesystem->makeDirectory($directory, 0755, true);
            }
        });

        copy(__DIR__.'/tailwindcss-stubs/resources/css/site.css', resource_path('css/site.css'));
    }

    protected static function updateBootstrapping()
    {
        copy(__DIR__.'/tailwindcss-stubs/tailwind.js', base_path('tailwind.js'));

        copy(__DIR__.'/tailwindcss-stubs/webpack.mix.js', base_path('webpack.mix.js'));

        copy(__DIR__.'/tailwindcss-stubs/resources/js/bootstrap.js', resource_path('js/bootstrap.js'));
    }

    protected static function updateWelcomePage()
    {
        (new Filesystem)->delete(resource_path('views/welcome.antlers.html'));

        copy(__DIR__.'/tailwindcss-stubs/resources/views/welcome.antlers.html', resource_path('views/welcome.antlers.html'));
    }
}
