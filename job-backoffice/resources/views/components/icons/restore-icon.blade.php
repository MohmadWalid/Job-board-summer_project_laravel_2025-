@props(['action'])

<form action="{{ $action }}" method="POST" {{ $attributes }}>
    @csrf
    @method('PUT')

    <button type="submit" class="text-green-600 hover:text-green-900 transition-colors duration-200">
        <svg class="w-5 h-5 mr-2 -ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
        </svg>
    </button>
</form>
