@props([
    'type' => 'submit',
    'form' => null,
    'label' => 'Save',
])

<button type="{{ $type }}" @if ($form) form="{{ $form }}" @endif
    {{ $attributes->merge(['class' => 'inline-flex items-center px-6 py-3 border-2 border-transparent rounded-lg shadow-md text-sm font-semibold text-white bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 hover:shadow-lg focus:outline-none focus:ring-4 focus:ring-indigo-300 focus:ring-opacity-50 transform hover:scale-105 transition-all duration-300 ease-in-out group']) }}>

    <svg xmlns="http://www.w3.org/2000/svg"
        class="w-4 h-4 mr-2 transform transition-all duration-300 group-hover:scale-110 group-hover:rotate-12"
        fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5">
        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
    </svg>

    {{ $slot->isEmpty() ? $label : $slot }}

</button>
