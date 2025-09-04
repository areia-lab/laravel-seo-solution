# Areia Lab – Laravel SEO Solution

SEO management package with Tailwind UI backend, OpenGraph & Twitter card support, and Blade helpers for easy rendering.

---

## 🚀 Requirements

- PHP **8.0+**
- Laravel **9.x / 10.x / 11.x / 12.x**
- Database supported by Laravel (MySQL, PostgreSQL, SQLite, etc.)
- Node & NPM (if you want to customize/publish Tailwind UI)

---

## 📦 Installation

1. **Require the package**:

```bash
composer require areia-lab/laravel-seo-solution
```

2. **Publish config & migrate**:

```bash

php artisan vendor:publish --tag=seo-config

php artisan vendor:publish --tag=seo-migrations

php artisan migrate
```

3. **Publish views**:

```bash
# Require For Production (Optional for Development)
php artisan vendor:publish --tag=seo-views
```

---

## ⚙️ Configuration

The config file `config/seo.php` contains:

```php
return [
    'route' => [
        'prefix' => env('SEO_PANEL_PREFIX', 'admin/seo'),
        'middleware' => ['web'],
    ],
    'disk' => env('SEO_DISK', 'public'),
    'defaults' => [
        'title_suffix' => '',
    ],
    'cache' => false,

    'panel' => [
        'title_prefix'  => 'Areia Lab SEO'
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
- Meta: `title`, `description`, `keywords`, `author`, `robots`, `canonical`
- OpenGraph: `title`, `description`, `type`, `image`
- Twitter: `title`, `description`, `card`, `image`

---

## 📝 Usage in Blade

Place directives inside your layout `<head>` section.
Remove `<title>` (tag) or `<title>{{ config('app.name', 'Laravel') }}</title>` (this line) from your layout`<head>` section.

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
@seoAutoPage

@seoPage('contact') // Using Route Name. e.g. "->name('contact')"

# or

@seoPage('contact-us') // Using URL Slug. e.g. "/contact-us"
```

or:

```blade
{!! app('seo')->forPage('contact')->render() !!}

# or

{!! app('seo')->forPage('contact-us')->render() !!}
```

---

### 3. Model-based (e.g. Blog Post)

```blade
@php
$post = Post::first();
@endphp

@seoModel($post)
```

or:

```blade
@php
$post = Post::first();
@endphp

{!! app('seo')->forModel($post)->render() !!}
```

### ✅ All Together in Layout

```blade
<head>
  @seoGlobal

  @seoAutoPage // This blade derivative is recommaded
  # or
  @isset($pageKey)
    @seoPage($pageKey) // Pass Data from blade. If Data changed from pannel it may not work. you need to fix statically
  @endisset
  # or
  @seoPage(Route::currentRouteName()) // it may not work if Route name means "->name('something')" not define or not match
  # or
  @seoPage(request()->path()) // it may not work if Route Uri "Route::get('something')" not match

  @isset($post)
      @seoModel($post)
  @endisset
</head>
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

  @seoAutoPage

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

### ✅ Page Example 1

```blade
['pageKey' => request()->path() ?? (Route::currentRouteName() ?? '/')]

# or

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

### ✅ Page Example 2

### Inside Layout

```blade
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>@yield('title', 'My Website')</title>

  <!-- Render SEO meta from pushed content -->
  @stack('head')
</head>
<body>
  @yield('content')
</body>
</html>
```

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

# or

@push('head')
  @seoPage('/contact-us')
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

### ✅ For Production or Host inside (Cpanel, AWS or Other)

```bash
php artisan vendor:publish --tag=seo-views
```

```bash
npm install
npm run build
```

Go To `<views\areia\seo\layouts\app.blade.php>`

```blade
# remove this line from `<head>`
@vite(['resources/css/app.css', 'resources/js/app.js'])

# Add
<!-- Styles / Scripts -->
<link rel="stylesheet" href="{{ asset('build/assets/{Your Generated CSS File Name}.css') }}">
<script src="{{ asset('build/assets/{Your Generated JS File Name}.js') }}" defer></script>

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
