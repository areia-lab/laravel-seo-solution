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
                <input type="text" name="og_type" value="{{ old('og_type', $seo->og_type ?? 'website') }}"
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
                <input type="text" name="twitter_title" value="{{ old('twitter_title', $seo->twitter_title) }}"
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
                    <option value="summary_large_image" {{ $card === 'summary_large_image' ? 'selected' : '' }}>
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
