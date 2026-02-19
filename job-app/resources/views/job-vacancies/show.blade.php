<x-app-layout>
    <div class="flex items-center justify-between flex-wrap gap-4">
        <!-- Back Button -->
        <x-back-button href="{{ route('dashboard') }}">
            Back to Jobs
        </x-back-button>

        <h2 class="font-semibold text-xl text-gray-100 leading-tight flex-1 text-center md:text-left">
            {{ $jobVacancy->title }} - Job Details
        </h2>

        <!-- Apply Button -->
        <a href="{{ route('job-vacancies.apply', $jobVacancy) }}"
            class="hidden md:flex group px-6 py-3 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 hover:shadow-xl items-center space-x-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            <span>Apply Now</span>
            <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor"
                viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6" />
            </svg>
        </a>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-toast-message />
            <!-- Job Vacancy Information Card -->
            <div
                class="glass-effect rounded-2xl overflow-hidden shadow-2xl mb-6 border border-gray-800 hover:border-gray-700 transition-all duration-300">
                <div class="p-8">
                    <!-- Header with gradient -->
                    <div class="flex items-center space-x-3 mb-6 pb-6 border-b border-gray-800">
                        <div
                            class="w-12 h-12 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <h3 class="text-2xl font-bold text-gray-100">Job Details</h3>
                    </div>

                    <!-- Job Information Grid -->
                    <dl class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <!-- Title -->
                        <div
                            class="bg-gray-900/50 rounded-xl p-4 border border-gray-800 hover:border-indigo-600/50 transition-all duration-300">
                            <dt class="text-sm font-medium text-gray-400 mb-2 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                                </svg>
                                Title
                            </dt>
                            <dd class="text-base font-semibold text-gray-100">
                                {{ $jobVacancy->title ?? 'N/A' }}
                            </dd>
                        </div>

                        <!-- Company -->
                        <div
                            class="bg-gray-900/50 rounded-xl p-4 border border-gray-800 hover:border-indigo-600/50 transition-all duration-300">
                            <dt class="text-sm font-medium text-gray-400 mb-2 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                                Company
                            </dt>
                            <dd class="text-base font-semibold text-gray-100">
                                {{ $jobVacancy->company->name }}
                            </dd>
                        </div>

                        <!-- Location -->
                        <div
                            class="bg-gray-900/50 rounded-xl p-4 border border-gray-800 hover:border-indigo-600/50 transition-all duration-300">
                            <dt class="text-sm font-medium text-gray-400 mb-2 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                Location
                            </dt>
                            <dd class="text-base text-gray-100">{{ $jobVacancy->location }}</dd>
                        </div>

                        <!-- Salary -->
                        <div
                            class="bg-gray-900/50 rounded-xl p-4 border border-gray-800 hover:border-indigo-600/50 transition-all duration-300">
                            <dt class="text-sm font-medium text-gray-400 mb-2 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Salary
                            </dt>
                            <dd class="text-base text-gray-100">
                                @if ($jobVacancy->salary)
                                    <span
                                        class="font-semibold text-green-400">${{ number_format($jobVacancy->salary, 2) }}</span>
                                @else
                                    <span class="text-gray-500 italic">Not specified</span>
                                @endif
                            </dd>
                        </div>

                        <!-- Type -->
                        <div
                            class="bg-gray-900/50 rounded-xl p-4 border border-gray-800 hover:border-indigo-600/50 transition-all duration-300">
                            <dt class="text-sm font-medium text-gray-400 mb-2 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                </svg>
                                Type
                            </dt>
                            <dd class="text-base text-gray-100">
                                @php
                                    $badgeClasses = match ($jobVacancy->type) {
                                        'full-time' => 'bg-gradient-to-r from-green-600 to-emerald-600 text-white',
                                        'contract' => 'bg-gradient-to-r from-blue-600 to-cyan-600 text-white',
                                        'remote' => 'bg-gradient-to-r from-purple-600 to-pink-600 text-white',
                                        'hybrid' => 'bg-gradient-to-r from-yellow-600 to-orange-600 text-white',
                                        default => 'bg-gradient-to-r from-gray-600 to-gray-700 text-white',
                                    };
                                @endphp
                                <span
                                    class="px-4 py-1.5 inline-flex text-sm font-semibold rounded-full {{ $badgeClasses }} shadow-lg">
                                    {{ ucfirst(str_replace('-', ' ', $jobVacancy->type)) }}
                                </span>
                            </dd>
                        </div>

                        <!-- Posted Date -->
                        <div
                            class="bg-gray-900/50 rounded-xl p-4 border border-gray-800 hover:border-indigo-600/50 transition-all duration-300">
                            <dt class="text-sm font-medium text-gray-400 mb-2 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                Posted Date
                            </dt>
                            <dd class="text-base text-gray-100">{{ $jobVacancy->created_at->format('M d, Y') }}</dd>
                        </div>

                        <!-- Description -->
                        <div
                            class="md:col-span-2 bg-gray-900/50 rounded-xl p-6 border border-gray-800 hover:border-indigo-600/50 transition-all duration-300">
                            <dt class="text-sm font-medium text-gray-400 mb-3 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h7" />
                                </svg>
                                Description
                            </dt>
                            <dd class="text-base text-gray-300 whitespace-pre-line leading-relaxed">
                                {{ $jobVacancy->description }}
                            </dd>
                        </div>

                        <!-- Required Skills -->
                        <div
                            class="md:col-span-2 bg-gray-900/50 rounded-xl p-6 border border-gray-800 hover:border-indigo-600/50 transition-all duration-300">
                            <dt class="text-sm font-medium text-gray-400 mb-3 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                </svg>
                                Required Skills
                            </dt>
                            <dd class="flex flex-wrap gap-2">
                                @php
                                    try {
                                        $skills = json_decode($jobVacancy->required_skills, true);
                                    } catch (\Exception $e) {
                                        $skills = [];
                                    }

                                    if (!is_array($skills)) {
                                        $skills = [$jobVacancy->required_skills];
                                    }
                                @endphp

                                @forelse ($skills as $skill)
                                    <span
                                        class="px-4 py-2 bg-gradient-to-r from-slate-700 to-slate-800 border border-slate-600 text-slate-100 text-sm font-medium rounded-full hover:from-indigo-600 hover:to-purple-600 hover:border-indigo-500 transition-all duration-300 transform hover:scale-105 shadow-md">
                                        {{ $skill }}
                                    </span>
                                @empty
                                    <span class="text-gray-500 italic">No specific skills listed.</span>
                                @endforelse
                            </dd>
                        </div>

                    </dl>
                </div>
            </div>

            <!-- Bottom Apply Button (Sticky on scroll) -->
            <div class="sticky bottom-6 z-50 px-4">
                <a href="{{ route('job-vacancies.apply', $jobVacancy) }}"
                    class="w-full group py-4 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white rounded-xl font-bold text-lg transition-all duration-300 transform hover:scale-105 hover:shadow-2xl flex items-center justify-center space-x-3 shadow-lg">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <span>Apply for This Position</span>
                    <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 7l5 5m0 0l-5 5m5-5H6" />
                    </svg>
                </a>
            </div>

        </div>
    </div>

    <style>
        .glass-effect {
            background: rgba(17, 24, 39, 0.7);
            backdrop-filter: blur(10px);
        }
    </style>
</x-app-layout>
