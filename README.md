# Statamic Frontend Preset for Tailwind CSS

A Statamic front-end scaffolding preset for [Tailwind CSS](https://tailwindcss.com).

![Statamic 3.0+](https://img.shields.io/badge/Statamic-3.0+-FF269E?style=for-the-badge&link=https://statamic.com)
![Tailwind 1.2+](https://img.shields.io/badge/TailwindCSS-1.2+-38b2ac?style=for-the-badge&link=https://tailwindcss.com)



## Usage

In a fresh install of Statamic 3, run the following commands.


1. Install this preset package

```
composer require statamic/preset-tailwindcss
```

2. Run the preset artisan command

```
# For a clean install
php artisan preset tailwindcss-clean

# To add to your current resources
php artisan preset tailwindcss
```

3. Install NPM dependencies and run webpack

```
npm install && npm run dev
```
