@props(['href', 'icon', 'label', 'count' => null, 'active' => false, 'badge' => 'bg-gray-200 text-gray-800'])

<a href="{{ $href }}"
    class="nav-item flex items-center justify-between px-4 py-3 hover:bg-blue-50
          {{ $active ? 'bg-blue-100 text-blue-800 font-semibold' : 'text-gray-700' }}">
    <div class="flex items-center gap-3">
        <i class="fas {{ $icon }}"></i>
        <span>{{ $label }}</span>
    </div>
    @if ($count !== null)
        <span class="badge {{ $badge }}">{{ $count }}</span>
    @endif
</a>
