<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if (request()->has('archived'))
                {{ __('Archived Categories') }}
            @else
                {{ __('Job Categories') }}
                <span
                    class="ml-3 inline-flex items-center px-3 py-1 rounded-full text-lg font-semibold bg-indigo-100 text-indigo-800">
                    {{ $JobCategories->total() }}
                </span>
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <x-toast-message />

            <div class="flex justify-between items-center py-8">
                <!-- Active and Archived buttons -->
                <div>
                    <x-status-toggle route-name="job-categories.index" active-label="Active Categories"
                        archived-label="Archived Categories" />
                </div>

                {{-- Add Button Component , To Add new category --}}
                <x-buttons.add-button href="{{ route('job-categories.create') }}">
                    Add New Category
                </x-buttons.add-button>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Job Categories
                                    </th>
                                    @if (!request()->has('archived'))
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Edit
                                        </th>
                                    @endif
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        @if (request()->has('archived'))
                                            Restore
                                        @else
                                            Archive
                                        @endif
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($JobCategories as $JobCategory)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $JobCategory->name }}
                                        </td>
                                        @if (!request()->has('archived'))
                                            {{-- Edit Button --}}
                                            <x-icons.edit-icon
                                                href="{{ route('job-categories.edit', $JobCategory->id) }}" />
                                        @endif

                                        <td class="px-10 py-4 whitespace-nowrap text-sm text-gray-500">
                                            @if (request()->has('archived'))
                                                <x-icons.restore-icon
                                                    action="{{ route('job-categories.restore', $JobCategory->id) }}" />
                                            @else
                                                <x-icons.archive-icon
                                                    action="{{ route('job-categories.destroy', $JobCategory->id) }}" />
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="{{ request()->has('archived') ? '2' : '3' }}"
                                            class="py-24 text-center align-middle">

                                            <div class="max-w-md mx-auto">
                                                <!-- Icon -->
                                                <div
                                                    class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-indigo-50">
                                                    <svg class="mx-auto h-16 w-16 text-gray-300" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="1.5"
                                                            d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                                                    </svg>
                                                </div>

                                                <!-- Title – Context Aware -->
                                                <h3 class="mt-6 text-xl font-semibold text-gray-900">
                                                    @if (request()->has('archived'))
                                                        No archived categories
                                                    @else
                                                        No job categories yet
                                                    @endif
                                                </h3>

                                                <!-- Subtitle – Helpful & Friendly -->
                                                <p class="mt-3 text-sm text-gray-500 leading-relaxed max-w-xs mx-auto">
                                                    @if (request()->has('archived'))
                                                        These categories are hidden from job postings but can be
                                                        restored anytime.
                                                    @else
                                                        Create categories like "Backend" or "DevOps" to
                                                        help candidates find your jobs faster.
                                                    @endif
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="mt-4">
                {{ $JobCategories->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
