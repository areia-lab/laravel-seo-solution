<x-seo>
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
                    <label class="relative flex cursor-pointer rounded-lg border p-4 focus:outline-none type-option">
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

                    <label class="relative flex cursor-pointer rounded-lg border p-4 focus:outline-none type-option">
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

                    <label class="relative flex cursor-pointer rounded-lg border p-4 focus:outline-none type-option">
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
                        <input type="text" name="seoable_type" value="{{ old('seoable_type', $seo->seoable_type) }}"
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 bg-white text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            placeholder="App\Models\Post">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Model ID</label>
                        <input type="number" name="seoable_id" value="{{ old('seoable_id', $seo->seoable_id) }}"
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 bg-white text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            placeholder="1">
                    </div>
                </div>
                <p class="mt-2 text-xs text-gray-500">Enter the full model class and ID of the specific instance</p>
            </div>

            <!-- Basic SEO Fields -->
            <div class="bg-white p-4 rounded-lg border border-gray-200">
                <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                    <i class="fas fa-tags mr-2 text-blue-500"></i>
                    Basic SEO Information
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Meta Title</label>
                        <input type="text" name="title" value="{{ old('title', $seo->title) }}"
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 bg-white text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                        <p class="mt-1 text-xs text-gray-500">Recommended: 50-60 characters</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Canonical URL</label>
                        <input type="url" name="canonical" value="{{ old('canonical', $seo->canonical) }}"
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 bg-white text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                            placeholder="https://example.com/page">
                    </div>
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Meta Description</label>
                    <textarea name="description" rows="3"
                        class="w-full px-4 py-2.5 rounded-lg border border-gray-300 bg-white text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">{{ old('description', $seo->description) }}</textarea>
                    <p class="mt-1 text-xs text-gray-500">Recommended: 150-160 characters</p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Keywords (comma separated)</label>
                    <input type="text" name="keywords" value="{{ old('keywords', $seo->keywords) }}"
                        class="w-full px-4 py-2.5 rounded-lg border border-gray-300 bg-white text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                    <p class="mt-1 text-xs text-gray-500">Separate keywords with commas (e.g. seo, marketing, web)</p>
                </div>
            </div>

            <!-- OpenGraph / Twitter -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div class="bg-white p-4 rounded-lg border border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                        <i class="fab fa-facebook mr-2 text-blue-600"></i>
                        OpenGraph Meta Tags
                    </h3>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">OG Title</label>
                        <input type="text" name="og_title" value="{{ old('og_title', $seo->og_title) }}"
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 bg-white text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">OG Description</label>
                        <textarea name="og_description" rows="2"
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 bg-white text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">{{ old('og_description', $seo->og_description) }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">OG Type</label>
                        <input type="text" name="og_type"
                            value="{{ old('og_type', $seo->og_type ?? 'website') }}"
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 bg-white text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">OG Image</label>
                        <input type="file" name="og_image" accept="image/*"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        @if ($seo->og_image)
                            <div class="mt-3 flex items-center">
                                <img src="{{ $seo->og_image }}" class="h-20 w-20 object-cover rounded border">
                                <span class="ml-3 text-sm text-gray-500">Current image</span>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="bg-white p-4 rounded-lg border border-gray-200">
                    <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
                        <i class="fab fa-twitter mr-2 text-blue-400"></i>
                        Twitter Meta Tags
                    </h3>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Twitter Title</label>
                        <input type="text" name="twitter_title"
                            value="{{ old('twitter_title', $seo->twitter_title) }}"
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 bg-white text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Twitter Description</label>
                        <textarea name="twitter_description" rows="2"
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 bg-white text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">{{ old('twitter_description', $seo->twitter_description) }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Twitter Card Type</label>
                        <select name="twitter_card"
                            class="w-full px-4 py-2.5 rounded-lg border border-gray-300 bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                            @php $card = old('twitter_card', $seo->twitter_card ?? 'summary_large_image'); @endphp
                            <option value="summary" {{ $card === 'summary' ? 'selected' : '' }}>Summary</option>
                            <option value="summary_large_image"
                                {{ $card === 'summary_large_image' ? 'selected' : '' }}>
                                Summary with Large Image
                            </option>
                            <option value="app" {{ $card === 'app' ? 'selected' : '' }}>App</option>
                            <option value="player" {{ $card === 'player' ? 'selected' : '' }}>Player</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Twitter Image</label>
                        <input type="file" name="twitter_image" accept="image/*"
                            class="w-full px-4 py-2 rounded-lg border border-gray-300 bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                        @if ($seo->twitter_image)
                            <div class="mt-3 flex items-center">
                                <img src="{{ $seo->twitter_image }}" class="h-20 w-20 object-cover rounded border">
                                <span class="ml-3 text-sm text-gray-500">Current image</span>
                            </div>
                        @endif
                    </div>
                </div>
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

    @push('head')
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

        <style>
            .type-option {
                transition: all 0.2s ease;
            }

            .type-option:hover {
                transform: translateY(-2px);
                box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            }

            /* Improved input styling */
            input,
            textarea,
            select {
                border: 1px solid #d1d5db !important;
                background-color: white !important;
                color: #111827 !important;
                padding: 0.625rem 1rem !important;
            }

            input:focus,
            textarea:focus,
            select:focus {
                outline: none;
                border-color: transparent !important;
                box-shadow: 0 0 0 2px rgba(59, 130, 246, 0.5) !important;
            }

            /* File input styling */
            input[type="file"]::-webkit-file-upload-button {
                background: #eff6ff;
                color: #1d4ed8;
                font-weight: 600;
                border: 0;
                padding: 0.5rem 1rem;
                border-radius: 9999px;
                margin-right: 1rem;
                transition: all 0.2s;
            }

            input[type="file"]::-webkit-file-upload-button:hover {
                background: #dbeafe;
            }
        </style>
    @endpush
</x-seo>
