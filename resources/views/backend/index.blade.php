@extends('seo-solution::layouts.app')

@section('content')
  <div class="bg-white rounded-xl shadow p-6">
    <div class="flex items-center justify-between mb-4">
      <div>
        <h2 class="text-xl font-semibold">SEO Records</h2>
        <p class="text-sm text-gray-500">Manage global, page and model specific SEO metadata</p>
      </div>
      <a href="{{ route('seo.create') }}" class="inline-flex items-center rounded-lg bg-blue-600 px-4 py-2 text-white hover:bg-blue-700">Create</a>
    </div>

    <div class="overflow-x-auto">
      <table class="min-w-full text-left text-sm">
        <thead class="bg-gray-100 text-gray-700">
          <tr>
            <th class="px-4 py-2">ID</th>
            <th class="px-4 py-2">Type</th>
            <th class="px-4 py-2">Page/Model</th>
            <th class="px-4 py-2">Title</th>
            <th class="px-4 py-2">Updated</th>
            <th class="px-4 py-2 text-right">Actions</th>
          </tr>
        </thead>
        <tbody>
          @forelse($items as $row)
            <tr class="border-b last:border-0">
              <td class="px-4 py-2">{{ $row->id }}</td>
              <td class="px-4 py-2">
                <span class="rounded bg-gray-100 px-2 py-1 text-xs uppercase">{{ $row->type }}</span>
              </td>
              <td class="px-4 py-2">
                @if($row->type === 'model')
                  <span class="text-xs text-gray-600">{{ $row->seoable_type }}#{{ $row->seoable_id }}</span>
                @else
                  {{ $row->page ?? '-' }}
                @endif
              </td>
              <td class="px-4 py-2 truncate max-w-[240px]">{{ \Illuminate\Support\Str::limit($row->title, 60) }}</td>
              <td class="px-4 py-2 text-gray-500">{{ $row->updated_at->diffForHumans() }}</td>
              <td class="px-4 py-2 text-right">
                <a href="{{ route('seo.edit', $row) }}" class="text-blue-600 hover:underline mr-3">Edit</a>
                <form class="inline" method="POST" action="{{ route('seo.destroy', $row) }}" onsubmit="return confirm('Delete this SEO record?')">
                  @csrf @method('DELETE')
                  <button class="text-red-600 hover:underline">Delete</button>
                </form>
              </td>
            </tr>
          @empty
            <tr><td colspan="6" class="px-4 py-6 text-center text-gray-500">No records yet.</td></tr>
          @endforelse
        </tbody>
      </table>
    </div>

    <div class="mt-4">{{ $items->links() }}</div>
  </div>
@endsection
