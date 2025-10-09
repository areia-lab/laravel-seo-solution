    <div class="bg-white p-4 rounded-lg border border-gray-200">
        <h3 class="text-lg font-medium text-gray-900 mb-4 flex items-center">
            <i class="fas fa-code mr-2 text-blue-500"></i>
            Page Schema
        </h3>

        <div class="mb-4">
            <label class="block text-sm font-medium text-gray-700 mb-2">Page Schema</label>
            <textarea name="schema_code" rows="6"
                class="w-full px-4 py-2.5 rounded-lg border border-gray-300 bg-white text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition"
                placeholder="Paste your JSON-LD or schema script here...">{{ old('schema_code', $seo->schema_code ?? '') }}</textarea>
            <p class="mt-1 text-xs text-gray-500">Recommended: Add JSON-LD or other structured data scripts.
            </p>
        </div>
    </div>
