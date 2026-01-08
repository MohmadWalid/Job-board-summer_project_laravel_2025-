@php
    $isResumeTab = request('tab') == 'resume' || !request('tab');
    $isAifeedbackTab = request('tab') == 'aifeedback';
@endphp

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">

            <!-- Back Button -->
            <x-buttons.back-button href="{{ route('job-applications.index') }}">Back</x-back-button>

                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ $jobApplication->user->name }} | Applied to {{ $jobApplication->job_vacancy->title }}
                </h2>

                <!-- Edit & Archive buttons with icon -->
                <div class="flex space-x-4 pr-8">
                    {{-- Edit Button --}}
                    <x-buttons.edit-button
                        href="{{ route('job-applications.edit', ['job_application' => $jobApplication->id, 'redirect' => 'show']) }}">EDIT</x-buttons.edit-button>
                    {{-- Archive Button --}}
                    <x-buttons.archive-button
                        action="{{ route('job-applications.destroy', $jobApplication->id) }}">ARCHIVE</x-buttons.archive-button>
                </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <x-toast-message />

            <!-- Application Details card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-bold mb-4">Application Details</h3>
                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-6">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Applicant</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $jobApplication->user->name }} </dd>
                            <div class="text-sm text-gray-500">
                                {{ $jobApplication->user->email ?? 'N/A' }}
                            </div>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Job Vacancy</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                <a href="{{ route('job-vacancies.show', $jobApplication->job_vacancy->id) }}"
                                    target="_blank" rel="noopener noreferrer"
                                    class="text-indigo-600 hover:text-indigo-900 hover:underline transition-colors duration-200">
                                    {{ $jobApplication->job_vacancy->title }}
                                </a>
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Company</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                <a href="{{ route('companies.show', $jobApplication->job_vacancy->company_id) }}"
                                    target="_blank" rel="noopener noreferrer"
                                    class="text-indigo-600 hover:text-indigo-900 hover:underline transition-colors duration-200">
                                    {{ $jobApplication->job_vacancy->company->name }}
                                </a>
                            </dd>
                        </div>

                        <div>
                            <dt class="text-sm font-medium text-gray-500">Status</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                @switch($jobApplication->status)
                                    @case('Pending')
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            {{ $jobApplication->status }}
                                        </span>
                                    @break

                                    @case('Accepted')
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                            {{ $jobApplication->status }}
                                        </span>
                                    @break

                                    @case('Rejected')
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                            {{ $jobApplication->status }}
                                        </span>
                                    @break

                                    @default
                                        <span
                                            class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                            {{ $jobApplication->status }}
                                        </span>
                                @endswitch
                            </dd>
                        </div>

                    </dl>
                </div>
            </div>

            <!-- Tab navigation -->
            <div class="mb-6">
                <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200">
                    <li class="mr-2">
                        <a href="{{ route('job-applications.show', ['job_application' => $jobApplication->id, 'tab' => 'resume']) }}"
                            class="inline-block p-4 rounded-t-lg transition-colors duration-200
                            @if ($isResumeTab) text-indigo-600 border-b-2 border-indigo-600 font-bold
                            @else
                                hover:text-gray-600 hover:bg-gray-50 @endif">
                            Resume
                        </a>
                    </li>
                    <li class="mr-2">
                        <a href="{{ route('job-applications.show', ['job_application' => $jobApplication->id, 'tab' => 'aifeedback']) }}"
                            class="inline-block p-4 rounded-t-lg transition-colors duration-200
                            @if ($isAifeedbackTab) text-indigo-600 border-b-2 border-indigo-600 font-bold
                            @else
                                hover:text-gray-600 hover:bg-gray-50 @endif">
                            AI Feedback
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Tab content section -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if ($isResumeTab)
                    @include('job-application.partials.resume-tab', ['resume' => $jobApplication->resume])
                @endif
                @if ($isAifeedbackTab)
                    @include('job-application.partials.aifeedback-tab', [
                        'jobApplication' => $jobApplication,
                    ])
                @endif
            </div>
</x-app-layout>
