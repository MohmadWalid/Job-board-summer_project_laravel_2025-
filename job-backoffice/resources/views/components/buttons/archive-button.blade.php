{{-- 👉 "This component expects a variable called $action to be passed when someone uses it." --}}
@props(['action'])

<form action="{{ $action }}" method="POST" class="inline-block">
    @csrf
    @method('DELETE')
    <button type="submit" onclick="return confirm('Are you sure you want to delete this item?')"
        class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-red-600 to-red-700 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:from-red-700 hover:to-red-800 focus:from-red-700 focus:to-red-800 active:from-red-900 active:to-red-900 focus:outline-none focus:ring-4 focus:ring-red-300 focus:ring-opacity-50 transform hover:scale-105 transition-all duration-300 ease-in-out group shadow-md hover:shadow-lg">
        <svg xmlns="http://www.w3.org/2000/svg"
            class="h-4 w-4 mr-2 group-hover:scale-110 group-hover:rotate-12 transition-all duration-300"
            viewBox="0 0 20 20" fill="currentColor">
            <path fill-rule="evenodd"
                d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z"
                clip-rule="evenodd" />
        </svg>
        {{ $slot }}
    </button>
</form>
