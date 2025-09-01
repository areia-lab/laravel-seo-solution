@props(['title' => ''])

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ config('seo.panel.title_prefix') . ' - ' . ($title ?? '') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4361ee;
            --primary-light: #4895ef;
            --secondary: #3f37c9;
            --success: #4cc9f0;
            --danger: #f72585;
            --warning: #f8961e;
            --info: #4895ef;
            --dark: #212529;
            --light: #f8f9fa;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #f7fafc;
            color: #2d3748;
        }

        .sidebar {
            transition: all 0.3s ease;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .nav-item {
            transition: all 0.2s ease;
            border-radius: 0.5rem;
        }

        .nav-item:hover {
            transform: translateX(5px);
        }

        .badge {
            font-size: 0.75rem;
            padding: 0.25rem 0.5rem;
            border-radius: 9999px;
        }

        .btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            border-radius: 0.375rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .btn-primary {
            background-color: var(--primary);
            color: white;
        }

        .btn-primary:hover {
            background-color: var(--secondary);
            transform: translateY(-2px);
        }

        .btn-danger {
            background-color: var(--danger);
            color: white;
        }

        .btn-danger:hover {
            background-color: #d1146a;
            transform: translateY(-2px);
        }

        .search-input {
            transition: all 0.3s ease;
            border: 1px solid #e2e8f0;
        }

        .search-input:focus {
            box-shadow: 0 0 0 3px rgba(66, 153, 225, 0.5);
        }

        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                top: 0;
                left: -100%;
                z-index: 50;
                height: 100vh;
            }

            .sidebar.active {
                left: 0;
            }
        }

        /* Animation for alerts */
        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .alert {
            animation: slideIn 0.3s ease;
        }
    </style>
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

    <script>
        // Mobile sidebar toggle
        const mobileMenuButton = document.getElementById('mobileMenuButton');
        const sidebar = document.getElementById('sidebar');
        const mobileOverlay = document.getElementById('mobileOverlay');

        function toggleSidebar() {
            sidebar.classList.toggle('active');
            sidebar.classList.toggle('hidden');
            mobileOverlay.classList.toggle('hidden');
            document.body.classList.toggle('overflow-hidden');
        }

        mobileMenuButton?.addEventListener('click', toggleSidebar);
        mobileOverlay?.addEventListener('click', toggleSidebar);
    </script>

    @stack('scripts')
</body>

</html>
