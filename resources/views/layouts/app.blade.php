@props(['title' => ''])

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ config('seo.panel.title_prefix') . ' - ' . ($title ?: '') }}</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @include('seo-solution::partials.styles')

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
                    <x-seo::nav-item href="{{ route('seo.index') }}" icon="fa-list text-gray-600" label="All SEO"
                        :count="$totalCount" :active="!request('type')" />

                    <x-seo::nav-item href="{{ route('seo.index', ['type' => 'global']) }}"
                        icon="fa-globe text-green-600" label="Global" :count="$globalCount" :active="request('type') === 'global'"
                        badge="bg-green-100 text-green-800" />

                    <x-seo::nav-item href="{{ route('seo.index', ['type' => 'page']) }}" icon="fa-file text-yellow-600"
                        label="Pages" :count="$pageCount" :active="request('type') === 'page'" badge="bg-yellow-100 text-yellow-800" />

                    <x-seo::nav-item href="{{ route('seo.index', ['type' => 'model']) }}" icon="fa-cube text-purple-600"
                        label="Model" :count="$modelCount" :active="request('type') === 'model'" badge="bg-purple-100 text-purple-800" />
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

    @include('seo-solution::partials.scripts')

    @stack('scripts')
</body>

</html>
