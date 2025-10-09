<x-seo::layout title="SEO Manager">
    @push('head')
        @include('areia.seo.partials.form-style')
    @endpush

    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-900">{{ $seo->exists ? 'Edit SEO' : 'Create SEO' }}</h2>
            <a href="{{ route('seo.index') }}" class="text-gray-500 hover:text-gray-700">
                <i class="fas fa-arrow-left mr-1"></i> Back to list
            </a>
        </div>

        <form method="POST" enctype="multipart/form-data"
            action="{{ $seo->exists ? route('seo.update', $seo) : route('seo.store') }}" class="space-y-6">
            @csrf
            @if ($seo->exists)
                @method('PUT')
            @endif

            <!-- Type Selection -->
            <div class="bg-gray-50 p-4 rounded-lg">
                <label class="block text-sm font-medium text-gray-700 mb-2">Type</label>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-3">
                    @if (config('seo.menu.global'))
                        <label
                            class="relative flex cursor-pointer rounded-lg border p-4 focus:outline-none type-option">
                            <input type="radio" name="type" value="global" class="sr-only"
                                {{ old('type', $seo->type ?? 'global') === 'global' ? 'checked' : '' }}>
                            <div class="flex w-full items-center justify-between">
                                <div class="flex items-center">
                                    <div class="text-sm">
                                        <p class="font-medium text-gray-900">Global</p>
                                        <p class="text-gray-500">Site-wide SEO settings</p>
                                    </div>
                                </div>
                                <i class="fas fa-globe text-green-600 text-xl"></i>
                            </div>
                            <div
                                class="{{ old('type', $seo->type ?? 'global') === 'global' ? 'border-blue-500' : 'border-transparent' }} pointer-events-none absolute -inset-px rounded-lg border-2">
                            </div>
                        </label>
                    @endif

                    @if (config('seo.menu.pages'))
                        <label
                            class="relative flex cursor-pointer rounded-lg border p-4 focus:outline-none type-option">
                            <input type="radio" name="type" value="page" class="sr-only"
                                {{ old('type', $seo->type ?? 'global') === 'page' ? 'checked' : '' }}>
                            <div class="flex w-full items-center justify-between">
                                <div class="flex items-center">
                                    <div class="text-sm">
                                        <p class="font-medium text-gray-900">Page</p>
                                        <p class="text-gray-500">Specific page SEO</p>
                                    </div>
                                </div>
                                <i class="fas fa-file text-yellow-600 text-xl"></i>
                            </div>
                            <div
                                class="{{ old('type', $seo->type ?? 'global') === 'page' ? 'border-blue-500' : 'border-transparent' }} pointer-events-none absolute -inset-px rounded-lg border-2">
                            </div>
                        </label>
                    @endif

                    @if (config('seo.menu.model'))
                        <label
                            class="relative flex cursor-pointer rounded-lg border p-4 focus:outline-none type-option">
                            <input type="radio" name="type" value="model" class="sr-only"
                                {{ old('type', $seo->type ?? 'global') === 'model' ? 'checked' : '' }}>
                            <div class="flex w-full items-center justify-between">
                                <div class="flex items-center">
                                    <div class="text-sm">
                                        <p class="font-medium text-gray-900">Model</p>
                                        <p class="text-gray-500">Model instance SEO</p>
                                    </div>
                                </div>
                                <i class="fas fa-cube text-purple-600 text-xl"></i>
                            </div>
                            <div
                                class="{{ old('type', $seo->type ?? 'global') === 'model' ? 'border-blue-500' : 'border-transparent' }} pointer-events-none absolute -inset-px rounded-lg border-2">
                            </div>
                        </label>
                    @endif

                </div>
            </div>

            <!-- Dynamic Fields based on Type -->
            <div id="pageField" class="hidden transition-all duration-300 bg-blue-50 p-4 rounded-lg">
                <label class="block text-sm font-medium text-gray-700 mb-2">Page Identifier</label>
                <input type="text" name="page" value="{{ old('page', $seo->page) }}"
                    class="w-full px-4 py-2.5 rounded-lg border border-gray-300 bg-white text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                    placeholder="home, contact, about">
                <p class="mt-1 text-xs text-gray-500">Enter the page identifier (route name or slug)</p>
            </div>

            <div id="modelFields" class="hidden transition-all duration-300 bg-purple-50 p-4 rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Model Class</label>
                        <input type="text" id="modelClass" name="seoable_type"
                            value="{{ old('seoable_type', $seo->seoable_type) }}"
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 bg-white text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            placeholder="App\Models\Post">
                    </div>

                    <!-- Model Instance (AJAX Searchable Dropdown) -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Select Model Instance ID</label>
                        <select id="modelInstance" name="seoable_id"
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 bg-white text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                            <option value="{{ old('seoable_id', $seo->seoable_id) }}">
                                {{ old('seoable_id', $seo->seoable_id) ? 'Selected ID: ' . old('seoable_id', $seo->seoable_id) : 'Select Instance' }}
                            </option>
                        </select>
                    </div>

                </div>
                <p class="mt-2 text-xs text-gray-500">Enter the full model class and Select the specific instance
                </p>
            </div>

            <!-- Error Display -->
            @if ($errors->any())
                <div class="rounded-lg border border-red-200 bg-red-50 p-4 text-red-800">
                    <div class="flex items-center">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        <strong>Validation errors:</strong>
                    </div>
                    <ul class="list-disc ml-5 mt-2">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Basic SEO Fields -->
            @include('areia.seo.partials.basic-field', ['seo' => $seo])

            <!-- OpenGraph / Twitter -->
            @include('areia.seo.partials.og-field', ['seo' => $seo])

            <!-- Schema Fields -->
            @include('areia.seo.partials.schema-field', ['seo' => $seo])


            <!-- Form Actions -->
            <div class="flex justify-end gap-3 pt-4 border-t border-gray-200">
                <a href="{{ route('seo.index') }}"
                    class="flex items-center px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition">
                    <i class="fas fa-times mr-2"></i> Cancel
                </a>
                <button type="submit"
                    class="flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition">
                    <i class="fas fa-save mr-2"></i> {{ $seo->exists ? 'Update' : 'Create' }}
                </button>
            </div>
        </form>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Function to toggle fields based on selected type
                function toggleFields() {
                    const selectedType = document.querySelector('input[name="type"]:checked').value;
                    const pageField = document.getElementById('pageField');
                    const modelFields = document.getElementById('modelFields');

                    // Hide all first
                    pageField.classList.add('hidden');
                    modelFields.classList.add('hidden');

                    // Show relevant field
                    if (selectedType === 'page') {
                        pageField.classList.remove('hidden');
                    } else if (selectedType === 'model') {
                        modelFields.classList.remove('hidden');
                    }
                }

                // Add event listeners to all type options
                document.querySelectorAll('input[name="type"]').forEach(radio => {
                    radio.addEventListener('change', toggleFields);
                });

                // Initialize on page load
                toggleFields();

                // Add interactive styling to type options
                document.querySelectorAll('.type-option').forEach(option => {
                    option.addEventListener('click', function() {
                        document.querySelectorAll('.type-option').forEach(opt => {
                            opt.classList.remove('ring-2', 'ring-blue-500');
                        });
                        this.classList.add('ring-2', 'ring-blue-500');
                    });

                    // Initialize selected state
                    if (option.querySelector('input').checked) {
                        option.classList.add('ring-2', 'ring-blue-500');
                    }
                });
            });
        </script>
        <script>
            const modelInstancesUrl = "{{ route('seo.model.instance') }}";

            $(document).ready(function() {
                $('#modelInstance').select2({
                    placeholder: 'Search instance...',
                    ajax: {
                        url: modelInstancesUrl,
                        data: function(params) {
                            return {
                                q: params.term,
                                model: $('#modelClass').val() // read from text input
                            };
                        },
                        processResults: function(data) {
                            return {
                                results: data
                            };
                        }
                    }
                });

                // If user changes model class input, clear instance select
                $('#modelClass').on('change keyup', function() {
                    $('#modelInstance').val(null).trigger('change');
                });
            });
        </script>
    @endpush
</x-seo::layout>
