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

    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
        <!-- Meta Robots -->
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Meta Robots</label>
            <select name="meta_robots"
                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 bg-white text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                @php
                    $robotOptions = [
                        'index, follow' => 'Index, Follow',
                        'noindex, follow' => 'Noindex, Follow',
                        'index, nofollow' => 'Index, Nofollow',
                        'noindex, nofollow' => 'Noindex, Nofollow',
                    ];
                @endphp
                @foreach ($robotOptions as $value => $label)
                    <option value="{{ $value }}"
                        {{ old('meta_robots', $seo->meta_robots) === $value ? 'selected' : '' }}>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
            <p class="mt-1 text-xs text-gray-500">Select how search engines should index this page</p>
        </div>

        {{-- Meta Author --}}
        <div>
            <label class="block text-sm font-medium text-gray-700 mb-2">Meta Author</label>
            <input type="text" name="meta_author" value="{{ old('meta_author', $seo->meta_author) }}"
                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 bg-white text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                placeholder="John Doe">
            <p class="mt-1 text-xs text-gray-500">Enter the content author’s name</p>
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
