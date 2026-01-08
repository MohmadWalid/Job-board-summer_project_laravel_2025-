@php
    $isApplicationsTab = request('tab') == 'applications' || !request('tab');
@endphp

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">

            <!-- Back Button -->
            <x-buttons.back-button href="{{ route('job-vacancies.index') }}">Back</x-buttons.back-button>

            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $jobVacancy->title }}
            </h2>

            <!-- Edit & Archive buttons -->
            <div class="flex space-x-4 pr-8">
                {{-- Edit Button --}}
                <x-buttons.edit-button
                    href="{{ route('job-vacancies.edit', ['job_vacancy' => $jobVacancy->id, 'redirect' => 'show']) }}">
                    EDIT
                </x-buttons.edit-button>

                {{-- Archive Button --}}
                <x-buttons.archive-button action="{{ route('job-vacancies.destroy', $jobVacancy->id) }}">
                    ARCHIVE
                </x-buttons.archive-button>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <x-toast-message />
            <!-- Job Vacancy information card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-bold mb-4">Job Vacancy Information</h3>
                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-6">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Title</dt>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $jobVacancy->title ?? 'N/A' }}
                            </td>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Company</dt>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                @if (!request()->has('archived'))
                                    <a href="{{ route('companies.show', $jobVacancy->company_id) }}"
                                        class="text-indigo-600 hover:text-indigo-900 hover:underline transition-colors duration-200">
                                        {{ $jobVacancy->company->name }}
                                    </a>
                                @else
                                    <span> {{ $jobVacancy->company->name }} </span>
                                @endif
                            </td>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Location</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $jobVacancy->location }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Salary</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                @if ($jobVacancy->salary)
                                    ${{ number_format($jobVacancy->salary, 2) }}
                                @else
                                    <span class="text-gray-500 italic">N/A</span>
                                @endif
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Type</dt>
                            <dd class="mt-1 text-sm text-gray-900 flex items-center">
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
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Posted Date</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $jobVacancy->created_at->format('M d, Y') }}</dd>
                        </div>
                        <div class="sm:col-span-2">
                            <dt class="text-sm font-medium text-gray-500">Description</dt>
                            <dd class="mt-1 text-sm text-gray-900 whitespace-pre-line leading-relaxed">
                                {{ $jobVacancy->description }}
                            </dd>
                        </div>
                        <div class="sm:col-span-2">
                            <dt class="text-sm font-medium text-gray-500">Required Skills</dt>
                            <dd class="mt-1 text-sm text-gray-900 flex flex-wrap gap-2">
                                {{-- Decode JSON and display as badges --}}
                                @php
                                    // Decode the JSON string into a PHP array. Use try/catch for robustness.
                                    try {
                                        $skills = json_decode($jobVacancy->required_skills, true);
                                    } catch (\Exception $e) {
                                        $skills = [];
                                    }

                                    // Check if decoding was successful and it's an array
if (is_array($skills)) {
    // Use a fixed color for skill badges (e.g., slate)
    $skillBadgeClasses = 'bg-slate-100 text-slate-800';
} else {
    // If decoding failed or it's not a JSON array, treat it as a single string
                                        $skills = [$jobVacancy->required_skills];
                                        $skillBadgeClasses = 'bg-red-100 text-red-800'; // Fallback if data is not JSON
                                    }
                                @endphp

                                @forelse ($skills as $skill)
                                    <span
                                        class="px-3 py-1 inline-flex text-sm leading-5 font-medium rounded-full {{ $skillBadgeClasses }}">
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

            <!-- Tab navigation -->
            <div class="mb-6">
                <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200">
                    <li class="mr-2">
                        <a href="{{ route('job-vacancies.show', ['job_vacancy' => $jobVacancy->id, 'tab' => 'applications']) }}"
                            class="inline-block p-4 rounded-t-lg transition-colors duration-200 text-indigo-600 border-b-2 border-indigo-600 font-bold">
                            Applications
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Tab content section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="p-6">
                        <!-- Header section with company name -->
                        <div class="flex justify-between items-center mb-6">
                            <h3 class="text-xl font-semibold text-gray-900">Applications
                                <span
                                    class="ml-3 inline-flex items-center px-3 py-1 rounded-full text-lg font-semibold bg-indigo-100 text-indigo-800">
                                    {{ $jobVacancy->job_applications->count() }}
                                </span>
                            </h3>
                        </div>

                        <!-- Scrollable table container -->
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <!-- Table header row -->
                                    <tr>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Applicant Name
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Job Title
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Applied On
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status
                                        </th>
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Action
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <!-- Loop through job applications -->
                                    @forelse ($jobVacancy->job_applications as $application)
                                        <tr class="hover:bg-gray-50">
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $application->user->name ?? 'N/A' }}
                                                <div class="text-sm text-gray-500">
                                                    {{ $application->user->email }}
                                                </div>
                                            </td>

                                            <!-- Job Title Row -->
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $application->job_vacancy->title ?? 'N/A' }}
                                            </td>

                                            <!-- Applied Date -->
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                                <div>{{ $application->created_at->format('M d, Y') }}</div>
                                                <div class="text-xs text-gray-400">
                                                    {{ $application->created_at->diffForHumans() }}</div>
                                            </td>

                                            <!-- Status Row with color coding -->
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                @switch($application->status)
                                                    @case('Pending')
                                                        <span
                                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                                            {{ $application->status }}
                                                        </span>
                                                    @break

                                                    @case('Accepted')
                                                        <span
                                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                            {{ $application->status }}
                                                        </span>
                                                    @break

                                                    @case('Rejected')
                                                        <span
                                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                            {{ $application->status }}
                                                        </span>
                                                    @break

                                                    @default
                                                        <span
                                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                            {{ $application->status }}
                                                        </span>
                                                @endswitch
                                            </td>
                                            <!-- View icon -->
                                            <x-icons.view-icon
                                                href="{{ route('job-applications.show', $application->id) }}" />
                                        </tr>
                                        @empty
                                            <!-- Empty state message -->
                                            <tr>
                                                <td colspan="5" class="px-6 py-12 text-center">
                                                    <div class="max-w-md mx-auto">
                                                        <svg class="mx-auto h-16 w-16 text-gray-300" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="1.5"
                                                                d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                                                        </svg>
                                                        <p class="mt-4 text-lg font-medium text-gray-900">No applications
                                                            yet
                                                        </p>
                                                        <p class="text-sm text-gray-500">Candidates will appear here once
                                                            they
                                                            apply.</p>
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

    </x-app-layout>
