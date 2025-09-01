@if ($meta)
    <!-- Page Title -->
    <title>
        {{ trim(($meta->title ?? config('app.name')) . (config('seo-solution.defaults.title_suffix') ? ' ' . config('seo-solution.defaults.title_suffix') : '')) }}
    </title>

    <!-- Basic SEO Meta -->
    @isset($meta->description)
        <meta name="description" content="{{ e($meta->description) }}">
    @endisset

    @isset($meta->keywords)
        <meta name="keywords" content="{{ e($meta->keywords) }}">
    @endisset

    @isset($meta->robots)
        <meta name="robots" content="{{ e($meta->robots) }}">
    @endisset

    @isset($meta->author)
        <meta name="author" content="{{ e($meta->author) }}">
    @endisset

    <!-- Canonical -->
    <link rel="canonical" href="{{ $meta->canonical ?? url()->current() }}">

    <!-- Open Graph (OG) -->
    <meta property="og:type" content="{{ $meta->og_type ?? 'website' }}">
    <meta property="og:title" content="{{ $meta->og_title ?? ($meta->title ?? config('app.name')) }}">

    @isset($meta->og_description)
        <meta property="og:description" content="{{ e($meta->og_description) }}">
    @endisset

    <meta property="og:url" content="{{ url()->current() }}">

    @isset($meta->og_image)
        <meta property="og:image" content="{{ $meta->og_image }}">
    @endisset

    <!-- Twitter -->
    <meta name="twitter:card" content="{{ $meta->twitter_card ?? 'summary_large_image' }}">
    <meta name="twitter:title" content="{{ $meta->twitter_title ?? ($meta->title ?? config('app.name')) }}">

    @isset($meta->twitter_description)
        <meta name="twitter:description" content="{{ e($meta->twitter_description) }}">
    @endisset

    @isset($meta->twitter_image)
        <meta name="twitter:image" content="{{ $meta->twitter_image }}">
    @endisset
@endif
