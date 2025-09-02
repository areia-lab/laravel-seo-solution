@props(['title' => ''])

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ config('seo.panel.title_prefix') . ' - ' . ($title ?: '') }}</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @if (app()->environment('local') && file_exists(base_path('resources/js/app.js')))
        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/seo.css', 'resources/js/seo.js'])
    @else
        <link rel="stylesheet" href="{{ asset('vendor/seo/app.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/seo/seo.css') }}">
        <script src="{{ asset('vendor/seo/app.js') }}" defer></script>
        <script src="{{ asset('vendor/seo/seo.js') }}" defer></script>
    @endif


    @stack('head')
</head>

<body class="bg-gray-50">

    <!-- Mobile header -->
    <header class="bg-white shadow-md lg:hidden">
        <div class="flex justify-between items-center px-4 py-3">
            <div class="flex items-center">
                <button id="mobileMenuButton" class="text-gray-700 mr-3 focus:outline-none">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                <h1 class="text-xl font-bold text-gray-900">SEO Manager</h1>
            </div>
            <a href="{{ route('seo.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i>
                <span class="hidden sm:inline">Create</span>
            </a>
        </div>
    </header>

    <div class="flex">
        <!-- Sidebar -->
        <aside id="sidebar" class="sidebar w-64 bg-white flex-shrink-0 hidden lg:block h-screen overflow-y-auto">
            <div class="p-6">
                <h1 class="text-2xl font-bold text-gray-900 mb-8 flex items-center">
                    <i class="fas fa-search mr-3 text-blue-500"></i>
                    SEO Manager
                </h1>
                <nav class="space-y-2">
                    <!-- All SEO -->
                    <a href="{{ route('seo.index') }}"
                        class="nav-item flex items-center justify-between px-4 py-3 hover:bg-blue-50
                        {{ !request('type') ? 'bg-blue-100 text-blue-800 font-semibold' : 'text-gray-700' }}">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-list text-gray-600"></i>
                            <span>All SEO</span>
                        </div>
                        <span class="badge bg-gray-200 text-gray-800">
                            {{ $totalCount }}
                        </span>
                    </a>

                    <!-- Global -->
                    <a href="{{ route('seo.index', ['type' => 'global']) }}"
                        class="nav-item flex items-center justify-between px-4 py-3 hover:bg-blue-50
                        {{ request('type') === 'global' ? 'bg-blue-100 text-blue-800 font-semibold' : 'text-gray-700' }}">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-globe text-green-600"></i>
                            <span>Global</span>
                        </div>
                        <span class="badge bg-green-100 text-green-800">
                            {{ $globalCount }}
                        </span>
                    </a>

                    <!-- Pages -->
                    <a href="{{ route('seo.index', ['type' => 'page']) }}"
                        class="nav-item flex items-center justify-between px-4 py-3 hover:bg-blue-50
                        {{ request('type') === 'page' ? 'bg-blue-100 text-blue-800 font-semibold' : 'text-gray-700' }}">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-file text-yellow-600"></i>
                            <span>Pages</span>
                        </div>
                        <span class="badge bg-yellow-100 text-yellow-800">
                            {{ $pageCount }}
                        </span>
                    </a>

                    <!-- Model -->
                    <a href="{{ route('seo.index', ['type' => 'model']) }}"
                        class="nav-item flex items-center justify-between px-4 py-3 hover:bg-blue-50
                        {{ request('type') === 'model' ? 'bg-blue-100 text-blue-800 font-semibold' : 'text-gray-700' }}">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-cube text-purple-600"></i>
                            <span>Model</span>
                        </div>
                        <span class="badge bg-purple-100 text-purple-800">
                            {{ $modelCount }}
                        </span>
                    </a>
                </nav>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="flex-1 overflow-x-hidden overflow-y-auto p-4 md:p-6">
            @if (session('success'))
                <div
                    class="alert mb-6 rounded-lg border border-green-200 bg-green-50 p-4 text-green-800 flex items-center">
                    <i class="fas fa-check-circle mr-3"></i>
                    {{ session('success') }}
                </div>
            @endif

            {{ $slot }}
        </main>
    </div>

    <!-- Mobile sidebar overlay -->
    <div id="mobileOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden lg:hidden"></div>

    @stack('scripts')
</body>

</html>
