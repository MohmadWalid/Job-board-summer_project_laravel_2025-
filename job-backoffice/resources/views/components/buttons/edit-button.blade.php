{{-- 👉 "This component expects a variable called $href to be passed when someone uses it." --}}
@props(['href' => '#'])
<a href="{{ $href }}"
    class="inline-flex items-center px-5 py-2.5 bg-gradient-to-r from-indigo-600 to-indigo-700 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:from-indigo-700 hover:to-indigo-800 focus:from-indigo-700 focus:to-indigo-800 active:from-indigo-900 active:to-indigo-900 focus:outline-none focus:ring-4 focus:ring-indigo-300 focus:ring-opacity-50 transform hover:scale-105 transition-all duration-300 ease-in-out group shadow-md hover:shadow-lg">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 group-hover:scale-110 transition-transform duration-300"
        viewBox="0 0 20 20" fill="currentColor">
        <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
        <path fill-rule="evenodd"
            d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z"
            clip-rule="evenodd" />
    </svg>
    {{ $slot }}
</a>
