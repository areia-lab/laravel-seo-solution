<!-- Table -->
<div class="bg-white rounded-xl shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        ID
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Type
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Page/Model</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Title
                    </th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Updated</th>
                    <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200" id="seoTableBody">
                @forelse($items as $row)
                    <tr class="hover:bg-gray-50 transition duration-150">
                        <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $row->id }}</td>
                        <td class="px-6 py-4 text-sm">
                            @php
                                $typeColors = [
                                    'global' => 'bg-green-100 text-green-800',
                                    'page' => 'bg-yellow-100 text-yellow-800',
                                    'model' => 'bg-purple-100 text-purple-800',
                                ];
                                $typeIcons = [
                                    'global' => 'fa-globe',
                                    'page' => 'fa-file',
                                    'model' => 'fa-cube',
                                ];
                            @endphp
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $typeColors[$row->type] ?? 'bg-gray-100 text-gray-800' }}">
                                <i class="fas {{ $typeIcons[$row->type] ?? 'fa-question' }} mr-1"></i>
                                {{ ucfirst($row->type) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">
                            @if ($row->type === 'model')
                                <span
                                    class="font-mono">{{ class_basename($row->seoable_type) }}#{{ $row->seoable_id }}</span>
                            @else
                                {{ $row->page ?? '-' }}
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-900">
                            <div class="truncate max-w-xs">{{ $row->title ?? '-' }}</div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-500">
                            <span title="{{ $row->updated_at }}">{{ $row->updated_at->diffForHumans() }}</span>
                        </td>
                        <td class="px-6 py-4 text-sm font-medium text-right">
                            <div class="flex justify-end space-x-2">
                                <a href="{{ route('seo.edit', $row) }}"
                                    class="text-blue-600 hover:text-blue-900 inline-flex items-center">
                                    <i class="fas fa-edit mr-1"></i>
                                    <span class="hidden md:inline">Edit</span>
                                </a>
                                <form method="POST" action="{{ route('seo.destroy', $row) }}"
                                    onsubmit="return confirm('Are you sure you want to delete this SEO record?')">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                        class="text-red-600 hover:text-red-900 inline-flex items-center">
                                        <i class="fas fa-trash mr-1"></i>
                                        <span class="hidden md:inline">Delete</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center">
                            <div class="flex flex-col items-center justify-center text-gray-400">
                                <i class="fas fa-inbox text-4xl mb-3"></i>
                                <p class="text-lg">No SEO records found</p>
                                <p class="text-sm mt-1">Get started by creating a new SEO record</p>
                                <a href="{{ route('seo.create') }}" class="btn btn-primary mt-4">
                                    <i class="fas fa-plus"></i>
                                    Create New Record
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<!-- Pagination -->
@if ($items->hasPages())
    <div class="bg-white rounded-xl shadow-sm p-4">
        <div class="pagination">
            {{ $items->links() }}
        </div>
    </div>
@endif
