<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if (request()->has('archived'))
                {{ __('Archived Job Vacancies') }}
            @else
                {{ __('Job Vacancies') }}
                <span
                    class="ml-3 inline-flex items-center px-3 py-1 rounded-full text-lg font-semibold bg-indigo-100 text-indigo-800">
                    {{ $jobVacancies->total() }}
                </span>
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <x-toast-message />

            <div class="flex justify-between items-center py-8">
                <!-- Active and Archived buttons -->
                <x-status-toggle route-Name="job-vacancies.index" active-Label="Active Jobs"
                    archived-Label="Archived Jobs" />

                <x-buttons.add-button href="{{ route('job-vacancies.create') }}">
                    Add New Job Vacancy
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
                                        Title
                                    </th>
                                    @if (Auth::user()->rule == 'admin')
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Company
                                        </th>
                                    @endif
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Location
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Type
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Salary
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Views
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
                                @forelse ($jobVacancies as $jobVacancy)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            @if (!request()->has('archived'))
                                                <a href="{{ route('job-vacancies.show', $jobVacancy->id) }}"
                                                    class="text-indigo-600 hover:text-indigo-900 hover:underline transition-colors duration-200">
                                                    {{ $jobVacancy->title }}
                                                </a>
                                            @else
                                                <span class="text-gray-900"> {{ $jobVacancy->title }} </span>
                                            @endif
                                        </td>

                                        @if (Auth::user()->rule == 'admin')
                                            {{-- Company Name --}}
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $jobVacancy->company->name ?? 'N/A' }}
                                            </td>
                                        @endif

                                        {{-- Location --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $jobVacancy->location }}
                                        </td>

                                        {{-- Type (Enum with Badge Styling) --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            @php
                                                $badgeClasses = match ($jobVacancy->type) {
                                                    'full-time' => 'bg-green-100 text-green-800',
                                                    'contract' => 'bg-blue-100 text-blue-800',
                                                    'remote' => 'bg-purple-100 text-purple-800',
                                                    'hybrid' => 'bg-yellow-100 text-yellow-800',
                                                    default => 'bg-gray-100 text-gray-800',
                                                };
                                            @endphp
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $badgeClasses }}">
                                                {{ ucfirst(str_replace('-', ' ', $jobVacancy->type)) }}
                                            </span>
                                        </td>

                                        {{-- Salary --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            ${{ number_format($jobVacancy->salary, 2) }}
                                        </td>

                                        {{-- View Count --}}
                                        <td class="px-10 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ number_format($jobVacancy->viewCount ?? 0) }}
                                        </td>

                                        {{-- Edit Button --}}
                                        @if (!request()->has('archived'))
                                            <x-icons.edit-icon
                                                href="{{ route('job-vacancies.edit', ['job_vacancy' => $jobVacancy->id, 'redirect' => 'index']) }}" />
                                        @endif

                                        {{-- Archive/Restore Button --}}
                                        <td class="px-10 py-4 whitespace-nowrap text-sm text-gray-500">
                                            @if (request()->has('archived'))
                                                {{-- Assuming a x-icons.restore-icon component exists and uses PUT method --}}
                                                <x-icons.restore-icon
                                                    action="{{ route('job-vacancies.restore', $jobVacancy->id) }}" />
                                            @else
                                                <x-icons.archive-icon
                                                    action="{{ route('job-vacancies.destroy', $jobVacancy->id) }}" />
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <!-- Empty State – No Job Vacancies -->
                                    <tr>
                                        <td colspan="8" class="py-20 text-center align-middle"> {{-- colspan = total columns --}}
                                            <div class="max-w-md mx-auto">
                                                <!-- Icon -->
                                                <div
                                                    class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-gray-100">
                                                    <svg class="h-12 w-12 text-gray-400" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="1.5"
                                                            d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                                    </svg>
                                                </div>

                                                <!-- Title -->
                                                <h3 class="mt-6 text-xl font-semibold text-gray-900">
                                                    @if (request()->has('archived'))
                                                        No archived job vacancies
                                                    @else
                                                        No active job vacancies yet
                                                    @endif
                                                </h3>

                                                <!-- Subtitle -->
                                                <p class="mt-3 text-sm text-gray-500 leading-relaxed max-w-xs mx-auto">
                                                    @if (request()->has('archived'))
                                                        All active jobs will appear in the main list.
                                                        <br>Archived jobs are hidden from candidates.
                                                    @else
                                                        Start posting your first job to attract talented candidates and
                                                        grow your team!
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
                {{ $jobVacancies->appends(request()->query())->links() }}
            </div>
        </div>
    </div>
</x-app-layout>
