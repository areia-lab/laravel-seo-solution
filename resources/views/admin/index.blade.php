<x-seo::layout title="SEO Manager">
    <div class="flex flex-col gap-6">
        <!-- Header + Search -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex flex-col lg:flex-row items-start lg:items-center justify-between gap-4">
                <div>
                    <h2 class="text-2xl font-bold text-gray-900">SEO Records</h2>
                    <p class="text-gray-500 mt-1">Manage global, page, and model-specific SEO metadata efficiently.</p>
                </div>
                <div class="flex flex-col sm:flex-row gap-3 w-full lg:w-auto">
                    <div class="relative flex-1">
                        <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                        <input type="text" id="search" placeholder="Search SEO records..."
                            class="search-input w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500" />
                    </div>
                    <a href="{{ route('seo.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i>
                        <span>Create New</span>
                    </a>
                    <a href="{{ config('seo.route.dashboard_url') }}" class="btn btn-danger">
                        <i class="fas fa-home"></i>
                        <span class="sm:inline">{{ config('seo.route.dashboard_label') }}</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Seo Table -->
        <x-seo::seo-table :items="$items" />
    </div>

    <!-- Search JS -->
    <script>
        const searchInput = document.getElementById('search');
        searchInput.addEventListener('input', function() {
            const query = this.value.toLowerCase();
            document.querySelectorAll('#seoTableBody tr').forEach(row => {
                if (row.querySelector('.text-lg')) return; // Skip the empty state row

                const title = row.cells[3].textContent.toLowerCase();
                const type = row.cells[1].textContent.toLowerCase();
                const pageModel = row.cells[2].textContent.toLowerCase();
                const id = row.cells[0].textContent.toLowerCase();

                row.style.display = title.includes(query) || type.includes(query) ||
                    pageModel.includes(query) || id.includes(query) ? '' : 'none';
            });
        });
    </script>

    <style>
        .pagination {
            display: flex;
            justify-content: center;
            margin-top: 1.5rem;
        }

        .pagination li {
            margin: 0 0.25rem;
        }

        .pagination a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 2.5rem;
            height: 2.5rem;
            border-radius: 0.375rem;
            border: 1px solid #e2e8f0;
            color: #4a5568;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .pagination a:hover {
            background-color: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .pagination .active a {
            background-color: var(--primary);
            color: white;
            border-color: var(--primary);
        }

        .table-row {
            transition: all 0.2s ease;
        }

        .table-row:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</x-seo::layout>
