# SEARCH APARTMENT

This is a simple project to make a search from db developed on top of `Laravel 8.1`. It uses `Vue 3`, `tailwindcss`, `Element UI` in the frontend. 

## Environment Requirements
 
 - `php`:  "^7.3|^8.0"
 - `node`:  "^14.0"
 - `mysql`

## Commands to up the website 

    - After successfully deploying in the required environment. You should come to the root of project and run the following commands.

- `composer install` - Installs php dependencies.
- `php artisan migrate --seed` - Runs both migration`s files and seeders
- `npm install` - Installs JS dependencies.
- `npm run prod` - Bundles the JS files.

## All commands which were used during development

- `composer create-project laravel/laravel:^8.1 app` - Creates Laravel Project
- `php artisan make:migration create_properties_table` - Creates `properties` table in the db
- `php artisan make:seeder PropertySeeder` - Creates seeder to insert initial data for `properties` table
- `php artisan migrate --seed` - Runs both migration`s files and seeders
- `composer require tightenco/ziggy inertiajs/inertia-laravel` - Adds two php dependencies.
- `npm install @inertiajs/inertia @inertiajs/inertia-vue3` - Inertia helps to manage routing in the frontend
- `npm install  vue vue-loader` - Installs Vue framework
- `npm install  tailwindcss` - Installs tailwindcss
- `npm install  element-plus` - Installs UI Elements
- `php artisan make:controller Property/PropertyController -m Property` - Creates Controller and Model for `properties`
    


## Note:
    Since I was using Element UI very first time so I could not know its properties properly to save estimated time I used Tailwindcss to layouts the Element UI`s components. The result was exciting to me.