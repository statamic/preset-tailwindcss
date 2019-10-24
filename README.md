# Statamic 3.0.0+ Frontend Preset for Tailwind CSS

A Statamic front-end scaffolding preset for [Tailwind CSS](https://tailwindcss.com) - a Utility-First CSS Framework for Rapid UI Development.

*Current version:* **Tailwind CSS 1.2+**

## Usage

1. Fresh install Statamic >= 3.0.0 and cd to your app.
2. Install this preset via `composer require statamic/preset-tailwindcss`. Statamic will automatically discover this package. No need to register the service provider.
3. Use `php artisan preset tailwindcss` to install on top of your current dependencies, OR use `php artisan preset tailwindcss-clean` to nuke those deps from orbit and start so fresh and so clean, clean.
4. `npm install && npm run dev && npm run dev` (this is required twice, due to the way that `laravel-mix-tailwind` installs the Tailwind CSS dependency)
5. `php artisan serve` (or equivalent) to run server and test preset.

### Config

The default `tailwind.js` configuration file included by this package simply uses the config from the Tailwind vendor files. Should you wish to make changes, you should remove the file and run `node_modules/.bin/tailwind init`, which will generate a fresh configuration file for you, which you are free to change to suit your needs.
