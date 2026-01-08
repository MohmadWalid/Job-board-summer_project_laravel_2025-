<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- Stats Cards Section --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">

                {{-- Active Users Card --}}
                <div
                    class="bg-gradient-to-br from-blue-50 to-white rounded-xl shadow-sm border border-blue-100 p-6 hover:shadow-md transition-shadow duration-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 uppercase tracking-wide">Active Users</p>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                <svg class="w-7 h-7 text-blue-600" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M16 11c1.66 0 2.99-1.34 2.99-3S17.66 5 16 5c-1.66 0-3 1.34-3 3s1.34 3 3 3zm-8 0c1.66 0 2.99-1.34 2.99-3S9.66 5 8 5C6.34 5 5 6.34 5 8s1.34 3 3 3zm0 2c-2.33 0-7 1.17-7 3.5V19h14v-2.5c0-2.33-4.67-3.5-7-3.5zm8 0c-.29 0-.62.02-.97.05 1.16.84 1.97 1.97 1.97 3.45V19h6v-2.5c0-2.33-4.67-3.5-7-3.5z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <p class="text-4xl font-bold text-gray-900">{{ $analaticsData['activeUsers'] }}</p>
                        <div class="flex items-center mt-2">
                            <p class="text-xs text-gray-500 mt-1">Last 30 days</p>
                        </div>
                    </div>
                </div>

                {{-- Total Job Vacancies Card --}}
                <div
                    class="bg-gradient-to-br from-purple-50 to-white rounded-xl shadow-sm border border-purple-100 p-6 hover:shadow-md transition-shadow duration-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 uppercase tracking-wide">Job Vacancies</p>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                                <svg class="w-7 h-7 text-purple-600" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M20 6h-4V4c0-1.11-.89-2-2-2h-4c-1.11 0-2 .89-2 2v2H4c-1.11 0-1.99.89-1.99 2L2 19c0 1.11.89 2 2 2h16c1.11 0 2-.89 2-2V8c0-1.11-.89-2-2-2zm-6 0h-4V4h4v2z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <p class="text-4xl font-bold text-gray-900">{{ $analaticsData['activeJobVacancies'] }}</p>
                        <div class="flex items-center mt-2">
                            <p class="text-xs text-gray-500 mt-1">All time</p>
                        </div>
                    </div>
                </div>

                {{-- Total Applications Card --}}
                <div
                    class="bg-gradient-to-br from-green-50 to-white rounded-xl shadow-sm border border-green-100 p-6 hover:shadow-md transition-shadow duration-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-sm font-medium text-gray-600 uppercase tracking-wide">Applications</p>
                        </div>
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                                <svg class="w-7 h-7 text-green-600" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M14 2H6c-1.1 0-1.99.9-1.99 2L4 20c0 1.1.89 2 1.99 2H18c1.1 0 2-.9 2-2V8l-6-6zm2 16H8v-2h8v2zm0-4H8v-2h8v2zm-3-5V3.5L18.5 9H13z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4">
                        <p class="text-4xl font-bold text-gray-900">{{ $analaticsData['activeJobApplication'] }}</p>
                        <div class="flex items-center mt-2">
                            <p class="text-xs text-gray-500 mt-1">All time</p>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Tables Section --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                {{-- Most Applied Jobs Table --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-6">
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">Most Applied Jobs</h3>
                                <p class="text-sm text-gray-500 mt-1">Top 5 positions by application count</p>
                            </div>
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-indigo-500" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M16 6l2.29 2.29-4.88 4.88-4-4L2 16.59 3.41 18l6-6 4 4 6.3-6.29L22 12V6z" />
                                </svg>
                            </div>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Job Title
                                        </th>
                                        @if (Auth()->user()->role == 'admin')
                                            <th scope="col"
                                                class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                                Company
                                            </th>
                                        @endif
                                        <th scope="col"
                                            class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Applications
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse ($analaticsData['mostAppliedJobs'] as $job)
                                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                                            {{-- Job Title --}}
                                            <td class="px-4 py-4 text-sm font-medium text-gray-900">
                                                <a href="{{ route('job-vacancies.show', $job->id) }}"
                                                    class="hover:text-indigo-600 transition-colors duration-150">
                                                    {{ $job->title }}
                                                </a>
                                            </td>
                                            @if (Auth()->user()->role == 'admin')
                                                {{-- Company Name --}}
                                                <td class="px-4 py-4 text-sm text-gray-600">
                                                    {{ $job->company->name ?? 'N/A' }}
                                                </td>
                                            @endif

                                            {{-- Application Count --}}
                                            <td class="px-4 py-4 text-sm text-right">
                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800">
                                                    {{ $job->totalCount ?? 0 }}
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        {{-- Empty State --}}
                                        <tr>
                                            <td colspan="3" class="px-4 py-12 text-center">
                                                <div class="flex flex-col items-center">
                                                    <svg class="w-12 h-12 text-gray-300 mb-3" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                                    </svg>
                                                    <p class="text-sm font-medium text-gray-900">No job applications yet
                                                    </p>
                                                    <p class="text-xs text-gray-500 mt-1">Data will appear once
                                                        candidates start applying</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- Conversion Rates Table --}}
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-6">
                            <div>
                                <h3 class="text-lg font-bold text-gray-900">Conversion Rates</h3>
                                <p class="text-sm text-gray-500 mt-1">Views to applications ratio</p>
                            </div>
                            <div class="flex-shrink-0">
                                <svg class="w-6 h-6 text-green-500" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zM9 17H7v-7h2v7zm4 0h-2V7h2v10zm4 0h-2v-4h2v4z" />
                                </svg>
                            </div>
                        </div>

                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col"
                                            class="px-4 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Job Title
                                        </th>
                                        <th scope="col"
                                            class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Views
                                        </th>
                                        <th scope="col"
                                            class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Apps
                                        </th>
                                        <th scope="col"
                                            class="px-4 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Rate
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse ($analaticsData['conversionRates'] as $job)
                                        <tr class="hover:bg-gray-50 transition-colors duration-150">
                                            {{-- Job Title --}}
                                            <td class="px-4 py-4 text-sm font-medium text-gray-900">
                                                <a href="{{ route('job-vacancies.show', $job->id) }}"
                                                    class="hover:text-indigo-600 transition-colors duration-150">
                                                    {{ Str::limit($job->title, 25) }}
                                                </a>
                                            </td>

                                            {{-- View Count --}}
                                            <td class="px-4 py-4 text-sm text-gray-600 text-right">
                                                {{ number_format($job->viewCount ?? 0) }}
                                            </td>

                                            {{-- Application Count --}}
                                            <td class="px-4 py-4 text-sm text-gray-600 text-right">
                                                {{ number_format($job->totalCount ?? 0) }}
                                            </td>

                                            {{-- Conversion Rate --}}
                                            <td class="px-4 py-4 text-sm text-right">
                                                @php
                                                    $rate = $job->conversionRate ?? 0;
                                                    // Determine badge color based on conversion rate
                                                    if ($rate >= 12) {
                                                        $badgeColor = 'bg-green-100 text-green-800';
                                                    } elseif ($rate >= 8) {
                                                        $badgeColor = 'bg-yellow-100 text-yellow-800';
                                                    } else {
                                                        $badgeColor = 'bg-orange-100 text-orange-800';
                                                    }
                                                @endphp

                                                <span
                                                    class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $badgeColor }}">
                                                    {{ number_format($rate, 1) }}%
                                                </span>
                                            </td>
                                        </tr>
                                    @empty
                                        {{-- Empty State --}}
                                        <tr>
                                            <td colspan="4" class="px-4 py-12 text-center">
                                                <div class="flex flex-col items-center">
                                                    <svg class="w-12 h-12 text-gray-300 mb-3" fill="none"
                                                        stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2"
                                                            d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                                                    </svg>
                                                    <p class="text-sm font-medium text-gray-900">No conversion data
                                                        available</p>
                                                    <p class="text-xs text-gray-500 mt-1">Data will appear once jobs
                                                        receive views and applications</p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
