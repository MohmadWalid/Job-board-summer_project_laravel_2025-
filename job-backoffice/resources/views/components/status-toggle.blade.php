{{-- Status Toggle Component --}}
{{--
Usage Examples:
<x-status-toggle
    route-name="companies.index"
    active-label="Active Companies"
    archived-label="Archived Companies"
/>

<x-status-toggle
    route-name="users.index"
    active-label="Active Users"
    archived-label="Archived Users"
    param-name="archived"
/>
--}}

@props([
    'routeName' => '#',
    'activeLabel' => 'Active Items',
    'archivedLabel' => 'Archived Items',
    'paramName' => 'archived',
    'paramValue' => 'true',
])

<div>
    @if (request()->has($paramName))
        {{-- Active/Current State Button --}}
        <a href="{{ route($routeName) }}"
            class="inline-flex items-center px-6 py-3 border border-transparent text-sm font-semibold rounded-lg shadow-lg text-white bg-gradient-to-r from-blue-600 to-blue-700 hover:from-blue-700 hover:to-blue-800 focus:outline-none focus:ring-4 focus:ring-blue-300 focus:ring-opacity-50 transform hover:scale-105 transition-all duration-300 ease-in-out">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z">
                </path>
            </svg>
            {{ $activeLabel }}
        </a>
    @else
        {{-- Toggle to Archived State Button --}}
        <a href="{{ route($routeName, [$paramName => $paramValue]) }}"
            class="inline-flex items-center px-6 py-3 border border-gray-300 text-sm font-semibold rounded-lg shadow-md text-gray-700 bg-white hover:bg-gray-50 hover:border-gray-400 focus:outline-none focus:ring-4 focus:ring-gray-200 focus:ring-opacity-50 transform hover:scale-105 transition-all duration-300 ease-in-out">
            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8l6 6 6-6">
                </path>
            </svg>
            {{ $archivedLabel }}
        </a>
    @endif
</div>
