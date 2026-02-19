@props([
    'href' => '#',
    'label' => null,
])

<a href="{{ $href }}"
    {{ $attributes->merge(['class' => 'inline-block px-6 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white rounded-lg font-medium transition-all duration-300 transform hover:scale-105 hover:shadow-lg text-center']) }}>

    {{ $slot->isEmpty() ? $label : $slot }}
</a>
