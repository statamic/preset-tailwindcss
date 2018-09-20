<?php

namespace StatamicFrontendPresets\TailwindCssPreset;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Console\PresetCommand;

class TailwindCssPresetServiceProvider extends ServiceProvider
{
    public function boot()
    {
        PresetCommand::macro('tailwindcss', function ($command) {
            TailwindCssPreset::install();

            $command->info('Tailwind CSS scaffolding installed successfully.');
            $command->info('Please run "npm install && npm run dev" to compile your fresh scaffolding.');
        });

        PresetCommand::macro('tailwindcss-clean', function ($command) {
            TailwindCssPreset::installClean();

            $command->info('Fresh and clean Tailwind CSS scaffolding installed successfully.');
            $command->info('Please run "npm install && npm run dev" to compile your fresh scaffolding.');
        });
    }
}
