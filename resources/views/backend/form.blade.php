@extends('seo-solution::layouts.app')

@section('content')
  <div class="bg-white rounded-xl shadow p-6">
    <h2 class="text-xl font-semibold mb-4">{{ $seo->exists ? 'Edit SEO' : 'Create SEO' }}</h2>

    <form method="POST" enctype="multipart/form-data"
          action="{{ $seo->exists ? route('seo.update', $seo) : route('seo.store') }}"
          class="space-y-6">
      @csrf
      @if($seo->exists) @method('PUT') @endif

      <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div>
          <label class="block text-sm font-medium text-gray-700">Type</label>
          <select name="type" id="type" class="mt-1 w-full rounded border-gray-300">
            @php $t = old('type', $seo->type ?? 'global'); @endphp
            <option value="global" {{ $t==='global'?'selected':'' }}>Global</option>
            <option value="page" {{ $t==='page'?'selected':'' }}>Page</option>
            <option value="model" {{ $t==='model'?'selected':'' }}>Model</option>
          </select>
        </div>

        <div id="pageField">
          <label class="block text-sm font-medium text-gray-700">Page (for type "page")</label>
          <input type="text" name="page" value="{{ old('page', $seo->page) }}" class="mt-1 w-full rounded border-gray-300" placeholder="home, contact">
        </div>

        <div id="modelFields">
          <label class="block text-sm font-medium text-gray-700">Model Class (for type "model")</label>
          <input type="text" name="seoable_type" value="{{ old('seoable_type', $seo->seoable_type) }}" class="mt-1 w-full rounded border-gray-300" placeholder="App\Models\Post">
          <label class="block text-sm font-medium text-gray-700 mt-2">Model ID</label>
          <input type="number" name="seoable_id" value="{{ old('seoable_id', $seo->seoable_id) }}" class="mt-1 w-full rounded border-gray-300" placeholder="1">
        </div>
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label class="block text-sm font-medium text-gray-700">Meta Title</label>
          <input type="text" name="title" value="{{ old('title', $seo->title) }}" class="mt-1 w-full rounded border-gray-300">
        </div>
        <div>
          <label class="block text-sm font-medium text-gray-700">Canonical URL</label>
          <input type="url" name="canonical" value="{{ old('canonical', $seo->canonical) }}" class="mt-1 w-full rounded border-gray-300">
        </div>
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700">Description</label>
        <textarea name="description" rows="3" class="mt-1 w-full rounded border-gray-300">{{ old('description', $seo->description) }}</textarea>
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700">Keywords (comma separated)</label>
        <input type="text" name="keywords" value="{{ old('keywords', $seo->keywords) }}" class="mt-1 w-full rounded border-gray-300">
      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <h3 class="font-semibold mb-2">OpenGraph</h3>
          <label class="block text-sm">OG Title</label>
          <input type="text" name="og_title" value="{{ old('og_title', $seo->og_title) }}" class="mt-1 w-full rounded border-gray-300">
          <label class="block text-sm mt-2">OG Description</label>
          <textarea name="og_description" rows="2" class="mt-1 w-full rounded border-gray-300">{{ old('og_description', $seo->og_description) }}</textarea>
          <label class="block text-sm mt-2">OG Type</label>
          <input type="text" name="og_type" value="{{ old('og_type', $seo->og_type ?? 'website') }}" class="mt-1 w-full rounded border-gray-300">
          <label class="block text-sm mt-2">OG Image</label>
          <input type="file" name="og_image" accept="image/*" class="mt-1 w-full rounded border-gray-300">
          @if($seo->og_image)
            <img src="{{ $seo->og_image }}" class="mt-2 h-20 rounded border">
          @endif
        </div>

        <div>
          <h3 class="font-semibold mb-2">Twitter</h3>
          <label class="block text-sm">Twitter Title</label>
          <input type="text" name="twitter_title" value="{{ old('twitter_title', $seo->twitter_title) }}" class="mt-1 w-full rounded border-gray-300">
          <label class="block text-sm mt-2">Twitter Description</label>
          <textarea name="twitter_description" rows="2" class="mt-1 w-full rounded border-gray-300">{{ old('twitter_description', $seo->twitter_description) }}</textarea>
          <label class="block text-sm mt-2">Twitter Card</label>
          <select name="twitter_card" class="mt-1 w-full rounded border-gray-300">
            @php $card = old('twitter_card', $seo->twitter_card ?? 'summary_large_image'); @endphp
            <option value="summary" {{ $card==='summary'?'selected':'' }}>summary</option>
            <option value="summary_large_image" {{ $card==='summary_large_image'?'selected':'' }}>summary_large_image</option>
            <option value="app" {{ $card==='app'?'selected':'' }}>app</option>
            <option value="player" {{ $card==='player'?'selected':'' }}>player</option>
          </select>
          <label class="block text-sm mt-2">Twitter Image</label>
          <input type="file" name="twitter_image" accept="image/*" class="mt-1 w-full rounded border-gray-300">
          @if($seo->twitter_image)
            <img src="{{ $seo->twitter_image }}" class="mt-2 h-20 rounded border">
          @endif
        </div>
      </div>

      @if ($errors->any())
        <div class="rounded border border-red-200 bg-red-50 p-3 text-red-800">
          <strong>Validation errors:</strong>
          <ul class="list-disc ml-5">
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <div class="flex justify-end gap-3">
        <a href="{{ route('seo.index') }}" class="rounded-lg border px-4 py-2">Cancel</a>
        <button class="rounded-lg bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">{{ $seo->exists ? 'Update' : 'Create' }}</button>
      </div>
    </form>
  </div>

  @push('head')
  <script>
  document.addEventListener('DOMContentLoaded', function () {
    const type = document.getElementById('type');
    const pageField = document.getElementById('pageField');
    const modelFields = document.getElementById('modelFields');

    function toggleFields() {
      const v = type.value;
      pageField.style.display = v === 'page' ? 'block' : 'none';
      modelFields.style.display = v === 'model' ? 'block' : 'none';
    }
    type.addEventListener('change', toggleFields);
    toggleFields();
  });
  </script>
  @endpush
@endsection
