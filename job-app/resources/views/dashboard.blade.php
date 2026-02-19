{{-- resources/views/dashboard.blade.php --}}

<x-app-layout>
    <div class="space-y-12">
        <!-- Header Section -->
        <div class="text-center space-y-4 opacity-0 animate-fade-in-up">
            <h1 class="text-5xl lg:text-6xl font-bold leading-tight">
                Job Dashboard
            </h1>
            <p class="text-2xl text-gray-300">
                Welcome back, <span class="gradient-text font-semibold">{{ Auth::user()->name }}</span> 👋
            </p>
        </div>

        <!-- Search & Filters Section -->
        <div class="space-y-8">
            <!-- Search Bar with Button -->
            <div class="max-w-3xl mx-auto opacity-0 animate-fade-in-up" style="animation-delay: 0.2s;">
                <form method="GET" action="{{ route('dashboard') }}" class="relative">

                    <input type="search" placeholder="Search for job vacancies by (name/company/location)"
                        name="search" value="{{ request('search') }}"
                        class="w-full pl-6 pr-48 py-5 glass-effect border border-gray-700/50 rounded-2xl focus:border-indigo-500
                        focus:ring-2 focus:ring-indigo-500/30 transition-all text-white placeholder-gray-400 text-lg">

                    <!-- Hidden input to preserve job_type filter when searching -->
                    @if (request('type'))
                        <input type="hidden" name="type" value="{{ request('type') }}">
                    @endif

                    <!-- Search Button (right side) -->
                    <button type="submit"
                        class="absolute right-3 top-1/2 transform -translate-y-1/2 px-8 py-3 bg-gradient-to-r from-indigo-600
                        to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold rounded-xl transition-all
                        duration-300 transform hover:scale-105 hover:shadow-xl">
                        Search
                    </button>
                </form>
            </div>

            <!-- Job Type Filters -->
            <div class="max-w-3xl mx-auto opacity-0 animate-fade-in-up" style="animation-delay: 0.4s;">
                <div class="flex flex-wrap justify-center gap-4">
                    <!-- All Jobs -->
                    <a href="{{ route('dashboard', ['search' => request('search')]) }}"
                        class="px-6 py-3 glass-effect rounded-xl transition-all duration-300 font-medium
            {{ !request('filter')
                ? 'bg-indigo-600 border-2 border-indigo-500 text-white shadow-lg shadow-indigo-500/50'
                : 'border border-gray-700/50 text-gray-400 hover:text-white hover:border-indigo-500/50' }}">
                        All Jobs
                    </a>

                    <!-- Full-time -->
                    <a href="{{ route('dashboard', ['filter' => 'full-time', 'search' => request('search')]) }}"
                        class="px-6 py-3 glass-effect rounded-xl transition-all duration-300 font-medium
            {{ request('filter') == 'full-time'
                ? 'bg-green-600 border-2 border-green-500 text-white shadow-lg shadow-green-500/50'
                : 'border border-green-800/50 text-green-400 hover:text-green-300 hover:bg-green-900/20' }}">
                        Full-time
                    </a>

                    <!-- Remote -->
                    <a href="{{ route('dashboard', ['filter' => 'remote', 'search' => request('search')]) }}"
                        class="px-6 py-3 glass-effect rounded-xl transition-all duration-300 font-medium
            {{ request('filter') == 'remote'
                ? 'bg-purple-600 border-2 border-purple-500 text-white shadow-lg shadow-purple-500/50'
                : 'border border-purple-800/50 text-purple-400 hover:text-purple-300 hover:bg-purple-900/20' }}">
                        Remote
                    </a>

                    <!-- Hybrid -->
                    <a href="{{ route('dashboard', ['filter' => 'hybrid', 'search' => request('search')]) }}"
                        class="px-6 py-3 glass-effect rounded-xl transition-all duration-300 font-medium
            {{ request('filter') == 'hybrid'
                ? 'bg-yellow-600 border-2 border-yellow-500 text-white shadow-lg shadow-yellow-500/50'
                : 'border border-yellow-800/50 text-yellow-400 hover:text-yellow-300 hover:bg-yellow-900/20' }}">
                        Hybrid
                    </a>

                    <!-- Contract -->
                    <a href="{{ route('dashboard', ['filter' => 'contract', 'search' => request('search')]) }}"
                        class="px-6 py-3 glass-effect rounded-xl transition-all duration-300 font-medium
            {{ request('filter') == 'contract'
                ? 'bg-blue-600 border-2 border-blue-500 text-white shadow-lg shadow-blue-500/50'
                : 'border border-blue-800/50 text-blue-400 hover:text-blue-300 hover:bg-blue-900/20' }}">
                        Contract
                    </a>
                </div>
            </div>
        </div>

        <!-- Jobs Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 opacity-0 animate-fade-in-up"
            style="animation-delay: 0.4s;">
            <!-- Job Cards -->
            @forelse ($jobs as $job)
                @php
                    $badgeClasses = match ($job->type) {
                        'full-time' => 'bg-green-900/30 text-green-400 border border-green-800/50',
                        'contract' => 'bg-blue-900/30 text-blue-400 border border-blue-800/50',
                        'remote' => 'bg-purple-900/30 text-purple-400 border border-purple-800/50',
                        'hybrid' => 'bg-yellow-900/30 text-yellow-400 border border-yellow-800/50',
                        default => 'bg-gray-800/50 text-gray-300 border border-gray-700',
                    };
                @endphp

                <div
                    class="glass-effect rounded-2xl p-8 hover:scale-105 hover:shadow-2xl transition-all duration-500 border border-gray-800/50 group cursor-pointer">
                    <div class="flex justify-between items-start mb-6">
                        <div>
                            <h3
                                class="text-2xl font-bold text-white group-hover:gradient-text transition-all duration-300">
                                {{ $job->title }}
                            </h3>
                            <p class="text-gray-400 mt-2 text-lg">{{ $job->company->name }}</p>
                        </div>

                        <div class="flex-shrink-0">
                            <span
                                class="px-4 py-2 text-sm font-semibold rounded-full whitespace-nowrap {{ $badgeClasses }}">
                                {{ ucfirst(str_replace('-', ' ', $job->type)) }}
                            </span>
                        </div>
                    </div>

                    <div class="space-y-3 text-gray-300">
                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5 text-indigo-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>{{ $job->location }}</span>
                        </div>

                        <div class="flex items-center space-x-3">
                            <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="font-semibold text-xl">{{ '$' . number_format($job->salary) }}/Year</span>
                        </div>
                    </div>

                    <div class="mt-8 pt-6 border-t border-gray-800 flex justify-end">
                        <a href="{{ route('job-vacancies.show', $job) }}"
                            class="inline-flex items-center px-5 py-2.5 bg-indigo-600/20 hover:bg-indigo-600/40 text-indigo-300 hover:text-white rounded-lg transition-all duration-300 group-hover:scale-105">
                            View Details
                            <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                    </div>
                </div>
            @empty
                <div class="col-span-full min-h-[60vh] flex flex-col items-center justify-center py-16 text-center">
                    <div class="mb-8">
                        <svg class="w-24 h-24 text-gray-500 opacity-70 mx-auto" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>

                    <h3 class="text-3xl font-bold text-white mb-4">No Jobs Found</h3>

                    <p class="text-gray-400 text-lg max-w-lg mb-8 leading-relaxed">
                        We couldn't find any job vacancies matching your search.<br>
                        Try adjusting your filters or search terms.
                    </p>

                    <a href="{{ route('dashboard') }}"
                        class="inline-flex items-center px-10 py-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-lg rounded-2xl transition-all duration-300 shadow-xl hover:shadow-indigo-500/40 transform hover:-translate-y-1">
                        Clear Search & Show All Jobs
                    </a>
                </div>
            @endforelse
        </div>
    </div>
    <div class="mt-12 flex justify-center">
        <div class="w-full max-w-2xl px-4">
            {{ $jobs->links() }}
        </div>
    </div>
</x-app-layout>
