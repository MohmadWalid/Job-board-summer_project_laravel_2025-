{{-- 👉 “This component expects a variable called $href to be passed when someone uses it.” --}}
@props(['href' => '#'])

<a href="{{ $href }}"
    class="inline-flex items-center px-6 py-3 border border-transparent text-sm font-semibold rounded-lg shadow-lg text-white bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 focus:outline-none focus:ring-4 focus:ring-indigo-300 focus:ring-opacity-50 transform hover:scale-105 hover:-translate-y-0.5 transition-all duration-300 ease-in-out group">
    <svg xmlns="http://www.w3.org/2000/svg" class="mr-2 h-5 w-5 group-hover:rotate-90 transition-transform duration-300"
        fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" />
    </svg>
    {{ $slot }}
</a>
