<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SEO Manager</title>
  <script src="https://cdn.tailwindcss.com"></script>
  @stack('head')
</head>
<body class="bg-gray-50 text-gray-900">
  <nav class="bg-white shadow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex h-16 items-center justify-between">
        <div class="flex items-center gap-3">
          <span class="text-xl font-semibold">SEO Manager</span>
          <a href="{{ route('seo.index') }}" class="text-sm text-blue-600 hover:underline">All</a>
          <a href="{{ route('seo.create') }}" class="text-sm text-blue-600 hover:underline">Create</a>
        </div>
      </div>
    </div>
  </nav>

  <main class="max-w-7xl mx-auto p-6">
    @if(session('success'))
      <div class="mb-4 rounded border border-green-200 bg-green-50 p-3 text-green-800">
        {{ session('success') }}
      </div>
    @endif

    @yield('content')
  </main>
</body>
</html>
