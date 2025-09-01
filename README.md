# Areia Lab – Laravel SEO Solution

SEO management package with Tailwind UI backend, OpenGraph & Twitter card support, and Blade helpers for easy rendering.

---

## 🚀 Requirements

- PHP **8.1+**  
- Laravel **10.x / 11.x / 12.x**  
- Database supported by Laravel (MySQL, PostgreSQL, SQLite, etc.)  
- Node & NPM (if you want to customize/publish Tailwind UI)  

---

## 📦 Installation

1. **(Optional) Add local path repo** to your `composer.json` (for local dev):  

```json
"repositories": [
  { "type": "path", "url": "packages/areia-lab/laravel-seo-solution" }
]
```

2. **Require the package**:  

```bash
composer require areia-lab/laravel-seo-solution:*
```

3. **Publish config, views & migrate**:  

```bash
php artisan vendor:publish --tag=seo-solution-config
php artisan vendor:publish --tag=seo-solution-views
php artisan migrate
php artisan storage:link
```

---

## ⚙️ Configuration

The config file `config/seo-solution.php` contains:  

```php
return [
  'route' => [
    'prefix' => 'admin/seo',
    'middleware' => ['web','auth'],
  ],
  'disk' => 'public',
  'defaults' => [
    'title_suffix' => '',
  ],
];
```

- Change `prefix` or `middleware` as needed.  
- Run `php artisan storage:link` so uploaded OG/Twitter images are accessible.  

---

## 🖥️ Admin Panel

Manage SEO meta records via:  

```
/admin/seo
```

Features:  

- Types: `global`, `page`, `model`  
- Meta: `title`, `description`, `keywords`, `canonical`  
- OpenGraph: `title`, `description`, `type`, `image`  
- Twitter: `title`, `description`, `card`, `image`  

---

## 📝 Usage in Blade

Place directives inside your layout `<head>` section.  

### 1. Global

```blade
@seoGlobal
```

or:

```blade
{!! app('seo')->global()->render() !!}
```

---

### 2. Page-specific

```blade
@seoPage('contact')
```

or:

```blade
{!! app('seo')->forPage('contact')->render() !!}
```

---

### 3. Model-based (e.g. Blog Post)

```blade
@seoModel($post)
```

or:

```blade
{!! app('seo')->forModel($post)->render() !!}
```

---

## 🔗 Examples

### ✅ Layout Example

```blade
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>@yield('title', 'My Website')</title>

  {{-- Inject SEO --}}
  @seoGlobal
  @isset($pageKey)
      @seoPage($pageKey)
  @endisset
  @isset($seoModel)
      @seoModel($seoModel)
  @endisset
</head>
<body>
  @yield('content')
</body>
</html>
```

---

### ✅ Page Example

```blade
@extends('layouts.app')

@section('title', 'Contact Us')

@section('content')
  <h2>Contact Us</h2>
  <p>Feel free to reach out!</p>
@endsection

@push('head')
  @seoPage('contact')
@endpush
```

---

### ✅ Model Example

```blade
@extends('layouts.app')

@section('title', $post->title)

@section('content')
  <h2>{{ $post->title }}</h2>
  <p>{{ $post->body }}</p>
@endsection

@push('head')
  @seoModel($post)
@endpush
```

---

### ✅ All Together in Layout

```blade
<head>
  @seoGlobal
  @seoPage(Route::currentRouteName())
  @isset($post)
      @seoModel($post)
  @endisset
</head>
```

---

## 🌱 Seeder

Seed default SEO meta:

```bash
php artisan db:seed --class="AreiaLab\LaravelSeoSolution\Database\Seeders\SeoMetaSeeder"
```

---

## 📖 License

MIT License – Use freely in personal & commercial projects.  
