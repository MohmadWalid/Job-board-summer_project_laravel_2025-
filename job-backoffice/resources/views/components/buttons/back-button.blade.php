{{-- 👉 "This component expects a variable called $href to be passed when someone uses it." --}}
@props(['href' => '#', 'label' => 'Back button'])

<a href="{{ $href }}"
    class="inline-flex items-center px-5 py-2.5 border border-gray-300 rounded-lg font-semibold text-xs text-gray-700 uppercase tracking-widest bg-white hover:bg-gray-50 hover:border-gray-400 focus:outline-none focus:ring-4 focus:ring-gray-200 focus:ring-opacity-50 transform hover:scale-105 transition-all duration-300 ease-in-out shadow-md hover:shadow-lg group"
    aria-label="{{ $label }}">
    <svg xmlns="http://www.w3.org/2000/svg"
        class="h-4 w-4 mr-2 transform transition-all duration-300 group-hover:-translate-x-1.5 group-hover:scale-110"
        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7" />
    </svg>
    {{ $slot }}
</a>
