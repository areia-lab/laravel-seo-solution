@if($meta)
  <title>{{ trim(($meta->title ?? config('app.name')) . (config('seo-solution.defaults.title_suffix') ? ' ' . config('seo-solution.defaults.title_suffix') : '')) }}</title>

  @if(!empty($meta->description))
    <meta name="description" content="{{ $meta->description }}">
  @endif
  @if(!empty($meta->keywords))
    <meta name="keywords" content="{{ $meta->keywords }}">
  @endif
  <link rel="canonical" href="{{ $meta->canonical ?? url()->current() }}">

  <meta property="og:type" content="{{ $meta->og_type ?? 'website' }}">
  <meta property="og:title" content="{{ $meta->og_title ?? $meta->title }}">
  @if(!empty($meta->og_description))
    <meta property="og:description" content="{{ $meta->og_description }}">
  @endif
  <meta property="og:url" content="{{ url()->current() }}">
  @if(!empty($meta->og_image))
    <meta property="og:image" content="{{ $meta->og_image }}">
  @endif

  <meta name="twitter:card" content="{{ $meta->twitter_card ?? 'summary_large_image' }}">
  <meta name="twitter:title" content="{{ $meta->twitter_title ?? $meta->title }}">
  @if(!empty($meta->twitter_description))
    <meta name="twitter:description" content="{{ $meta->twitter_description }}">
  @endif
  @if(!empty($meta->twitter_image))
    <meta name="twitter:image" content="{{ $meta->twitter_image }}">
  @endif
@endif
