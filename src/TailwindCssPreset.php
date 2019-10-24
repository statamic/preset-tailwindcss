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
                "autoprefixer" => "^9.6.1",
                "cross-env" => "^5.1",
                "postcss-import" => "^12.0.1",
                "postcss-nested" => "^4.1.2",
                "postcss-preset-env" => "^6.7.0",
                'laravel-mix' => '^4.0',
                'laravel-mix-purgecss' => '^4.0.0',
                "tailwindcss" => "^1.1.2"
            ];
        }

        return array_merge([
            'laravel-mix' => '^4.0',
            'laravel-mix-purgecss' => '^4.0.0',
            'laravel-mix-tailwind' => '^0.1.0',
            'vue-template-compiler' => '^2.610'
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
            $filesystem->delete(public_path('js/app.js'));
            $filesystem->delete(public_path('css/app.css'));

            if (! $filesystem->isDirectory($directory = resource_path('css'))) {
                $filesystem->makeDirectory($directory, 0755, true);
            }
        });

        copy(__DIR__.'/tailwindcss-stubs/resources/css/tailwind.css', resource_path('css/tailwind.css'));
    }

    protected static function updateBootstrapping()
    {
        copy(__DIR__.'/tailwindcss-stubs/tailwind.config.js', base_path('tailwind.config.js'));

        copy(__DIR__.'/tailwindcss-stubs/webpack.mix.js', base_path('webpack.mix.js'));

        copy(__DIR__.'/tailwindcss-stubs/resources/js/bootstrap.js', resource_path('js/bootstrap.js'));
    }

    protected static function updateWelcomePage()
    {
        tap(new Filesystem, function ($filesystem) {
            $filesystem->delete(resource_path('views/layout.antlers.html'));
            $filesystem->delete(resource_path('views/home.antlers.html'));
        });

        copy(__DIR__.'/tailwindcss-stubs/resources/views/layout.antlers.html', resource_path('views/layout.antlers.html'));
        copy(__DIR__.'/tailwindcss-stubs/resources/views/home.antlers.html', resource_path('views/home.antlers.html'));
        copy(__DIR__.'/tailwindcss-stubs/resources/views/nav.antlers.html', resource_path('views/nav.antlers.html'));
    }
}
