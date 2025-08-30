# Areia Lab – Laravel SEO Solution

SEO management package with Tailwind UI backend, OpenGraph & Twitter support, and Blade helpers.

## Install

1. Add a local path repo to your app's `composer.json` (if developing locally):
```json
"repositories": [
  { "type": "path", "url": "packages/areia-lab/laravel-seo-solution" }
]
```
2. Require the package:
```bash
composer require areia-lab/laravel-seo-solution:*
```
3. Publish & migrate:
```bash
php artisan vendor:publish --tag=seo-solution-config
php artisan vendor:publish --tag=seo-solution-views
php artisan migrate
php artisan storage:link
```

## Admin Panel

- URL prefix: `/admin/seo` (change via `config/seo-solution.php`)
- Default middleware: `['web','auth']`

## Rendering in Blade

Add inside your layout `<head>`:

- Global:
```blade
@seoGlobal
```
or
```blade
{!! app('seo')->global()->render() !!}
```

- Specific page:
```blade
@seoPage('contact')
```
or
```blade
{!! app('seo')->forPage('contact')->render() !!}
```

- Model-based:
```blade
@seoModel($post)
```
or
```blade
{!! app('seo')->forModel($post)->render() !!}
```

## Seeder

Register and run:
```php
AreiaLab\LaravelSeoSolution\Database\Seeders\SeoMetaSeeder::class
```
```bash
php artisan db:seed --class="AreiaLab\LaravelSeoSolution\Database\Seeders\SeoMetaSeeder"
```

## Notes
Ensure `php artisan storage:link` so uploaded images (OG/Twitter) resolve to public URLs.
