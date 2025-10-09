@props(['title' => ''])

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        {{ trim(config('seo.panel.title_prefix') . ($title ? ' - ' . $title : '')) }}
    </title>

    {{-- Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    {{-- App Styles / Scripts --}}
    @if (app()->environment('local'))
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
        <link rel="stylesheet" href="{{ asset('build/assets/app-BYGJbiDV.css') }}" />
        <script src="{{ asset('build/assets/app-Bj43h_rG.js') }}"></script>
    @endif

    {{-- Select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    @include('areia.seo.partials.styles')
    @stack('head')
</head>

<body class="bg-gray-50 text-gray-800 antialiased">

    <!-- Mobile Header -->
    <header class="bg-white shadow-md lg:hidden">
        <div class="flex justify-between items-center px-4 py-3">
            <div class="flex items-center">
                <button id="mobileMenuButton" aria-label="Toggle menu"
                    class="text-gray-700 mr-3 focus:outline-none hover:text-gray-900">
                    <i class="fas fa-bars text-xl"></i>
                </button>
                <h1 class="text-xl font-bold text-gray-900">SEO Manager</h1>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('seo.create') }}"
                    class="bg-blue-600 text-white px-3 py-2 rounded-lg hover:bg-blue-700 flex items-center gap-1">
                    <i class="fas fa-plus"></i>
                    <span class="hidden sm:inline">Create</span>
                </a>
                <a href="{{ config('seo.route.dashboard_url') }}"
                    class="bg-gray-200 text-gray-800 px-3 py-2 rounded-lg hover:bg-gray-300 flex items-center gap-1">
                    <i class="fas fa-home"></i>
                    <span class="hidden sm:inline">{{ config('seo.route.dashboard_label') }}</span>
                </a>
            </div>
        </div>
    </header>

    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside id="sidebar"
            class="sidebar w-64 bg-white border-r border-gray-200 flex-shrink-0 hidden lg:block h-screen overflow-y-auto z-50">
            <div class="p-6">
                <h1 class="text-2xl font-bold text-gray-900 mb-8 flex items-center">
                    <i class="fas fa-search mr-3 text-blue-500"></i>
                    SEO Manager
                </h1>

                <nav class="space-y-2">
                    <x-seo::nav-item href="{{ route('seo.index') }}" icon="fa-list text-gray-600" label="All SEO"
                        :count="$totalCount" :active="!request('type')" />

                    @if (config('seo.menu.global'))
                        <x-seo::nav-item href="{{ route('seo.index', ['type' => 'global']) }}"
                            icon="fa-globe text-green-600" label="Global" :count="$globalCount" :active="request('type') === 'global'"
                            badge="bg-green-100 text-green-800" />
                    @endif

                    @if (config('seo.menu.pages'))
                        <x-seo::nav-item href="{{ route('seo.index', ['type' => 'page']) }}"
                            icon="fa-file text-yellow-600" label="Pages" :count="$pageCount" :active="request('type') === 'page'"
                            badge="bg-yellow-100 text-yellow-800" />
                    @endif

                    @if (config('seo.menu.model'))
                        <x-seo::nav-item href="{{ route('seo.index', ['type' => 'model']) }}"
                            icon="fa-cube text-purple-600" label="Model" :count="$modelCount" :active="request('type') === 'model'"
                            badge="bg-purple-100 text-purple-800" />
                    @endif

                    <x-seo::nav-item href="{{ config('seo.route.dashboard_url') }}" icon="fa-dashboard text-red-600"
                        label="{{ config('seo.route.dashboard_label') }}" badge="bg-red-100 text-red-800" />
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

    <!-- Mobile Sidebar Overlay -->
    <div id="mobileOverlay" class="fixed inset-0 bg-black bg-opacity-50 z-40 hidden lg:hidden"></div>

    {{-- Scripts --}}
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    @include('areia.seo.partials.scripts')

    @stack('scripts')
</body>

</html>
