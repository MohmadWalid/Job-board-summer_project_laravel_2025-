<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if (request()->has('archived'))
                {{ __('Archived Companies') }}
            @else
                {{ __('Companies') }}
                <span
                    class="ml-3 inline-flex items-center px-3 py-1 rounded-full text-lg font-semibold bg-indigo-100 text-indigo-800">
                    {{ $companies->total() }}
                </span>
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <x-toast-message />

            <div class="flex justify-between items-center py-8">
                <!-- Active and Archived buttons -->
                <x-status-toggle route-name="companies.index" active-label="Active Companies"
                    archived-label="Archived Companies" />

                <x-buttons.add-button href="{{ route('companies.create') }}">
                    Add New Company
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
                                        Name
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Address
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Industry
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Website
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
                                @forelse ($companies as $company)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            @if (!request()->has('archived'))
                                                <a href="{{ route('companies.show', $company->id) }}"
                                                    class="text-indigo-600 hover:text-indigo-900 hover:underline transition-colors duration-200">
                                                    {{ $company->name }}
                                                </a>
                                            @else
                                                <span> {{ $company->name }} </span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $company->address }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $company->industry }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            @if ($company->website)
                                                <a href="{{ $company->website }}" target="_blank"
                                                    rel="noopener noreferrer"
                                                    class="text-indigo-600 hover:text-indigo-900 hover:underline transition-colors duration-200">
                                                    {{ $company->website }}
                                                </a>
                                            @else
                                                <span class="text-gray-500 italic">N/A</span>
                                            @endif
                                        </td>
                                        @if (!request()->has('archived'))
                                            {{-- Edit Button --}}
                                            <x-icons.edit-icon
                                                href="{{ route('companies.edit', ['company' => $company->id, 'redirect' => 'index']) }}" />
                                        @endif

                                        <td class="px-10 py-4 whitespace-nowrap text-sm text-gray-500">
                                            @if (request()->has('archived'))
                                                <x-icons.restore-icon
                                                    action="{{ route('companies.restore', $company->id) }}" />
                                            @else
                                                <x-icons.archive-icon
                                                    action="{{ route('companies.destroy', $company->id) }}" />
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="py-24 text-center align-middle">
                                            <div class="max-w-md mx-auto">
                                                <!-- Icon -->
                                                <div
                                                    class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-gray-100">
                                                    <svg class="h-12 w-12 text-gray-400" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="1.5"
                                                            d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                                    </svg>
                                                </div>

                                                <!-- Title -->
                                                <h3 class="mt-6 text-xl font-semibold text-gray-900">
                                                    @if (request()->has('archived'))
                                                        No archived companies
                                                    @else
                                                        No companies yet
                                                    @endif
                                                </h3>

                                                <!-- Subtitle -->
                                                <p class="mt-3 text-sm text-gray-500 leading-relaxed max-w-xs mx-auto">
                                                    @if (request()->has('archived'))
                                                        Archived companies are hidden from public view but can be
                                                        restored anytime.
                                                    @else
                                                        Add your first company to start posting job vacancies and
                                                        building your employer brand!
                                                    @endif
                                                </p>
                                            </div>
                                        </td>
                                    </tr>
                                @endempty
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="mt-4">
            {{ $companies->appends(request()->query())->links() }}
        </div>
    </div>
</div>
</x-app-layout>
