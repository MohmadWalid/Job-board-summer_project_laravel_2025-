@php
    $isJobsTab = request('tab') == 'jobs' || !request('tab');
    $isApplicationsTab = request('tab') == 'applications';
@endphp

<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            @can('viewAny', $company)
                <!-- Back Button -->
                <x-buttons.back-button href="{{ route('companies.index') }}">Back</x-back-button>
                @endcan

                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ $company->name }} Details
                </h2>

                <!-- Edit & Archive buttons with icon -->
                <div class="flex space-x-4 pr-8">
                    {{-- Edit Button --}}
                    <x-buttons.edit-button
                        href="{{ auth()->user()->role === 'admin'
                            ? route('companies.edit', [$company, 'redirect' => 'show'])
                            : route('my-company.edit', ['redirect' => 'show']) }}">EDIT</x-buttons.edit-button>

                    @can('delete', $company)
                        {{-- Only Show the Archive Button if the user is ADMIN --}}
                        {{-- Archive Button --}}
                        <x-buttons.archive-button
                            action="{{ route('companies.destroy', $company->id) }}">ARCHIVE</x-buttons.archive-button>
                    @endcan
                </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <x-toast-message />

            <!-- Company information card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-xl font-bold mb-4">Company Information</h3>
                    <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-6">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Company Owner</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $company->owner->name ?? 'N/A' }} </dd>
                            <div class="text-sm text-gray-500">
                                {{ $company->owner->email ?? 'N/A' }}
                            </div>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Address</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $company->address ?? 'N/A' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Industry</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $company->industry ?? 'N/A' }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Website</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                @if ($company->website)
                                    <a href="{{ $company->website }}" target="_blank" rel="noopener noreferrer"
                                        class="text-indigo-600 hover:text-indigo-900 hover:underline transition-colors duration-200">
                                        {{ $company->website }}
                                    </a>
                                @else
                                    <span class="text-gray-500 italic">N/A</span>
                                @endif
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>

            {{-- Only Show This Tab if the user is ADMIN --}}
            @if (auth()->user()->role == 'admin')
                <!-- Tab navigation -->
                <div class="mb-6">
                    <ul class="flex flex-wrap text-sm font-medium text-center text-gray-500 border-b border-gray-200">
                        <li class="mr-2">
                            <a href="{{ route('companies.show', ['company' => $company->id, 'tab' => 'jobs']) }}"
                                class="inline-block p-4 rounded-t-lg transition-colors duration-200
                            @if ($isJobsTab) text-indigo-600 border-b-2 border-indigo-600 font-bold
                            @else
                                hover:text-gray-600 hover:bg-gray-50 @endif">
                                Jobs
                            </a>
                        </li>
                        <li class="mr-2">
                            <a href="{{ route('companies.show', ['company' => $company->id, 'tab' => 'applications']) }}"
                                class="inline-block p-4 rounded-t-lg transition-colors duration-200
                            @if ($isApplicationsTab) text-indigo-600 border-b-2 border-indigo-600 font-bold
                            @else
                                hover:text-gray-600 hover:bg-gray-50 @endif">
                                Applications
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Tab content section -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    @if ($isJobsTab)
                        @include('company.partials.jobs-tab', ['company' => $company])
                    @endif
                    @if ($isApplicationsTab)
                        @include('company.partials.applications-tab', [
                            'company' => $company,
                            'applications' => $company->job_applications,
                        ])
                    @endif
                </div>
            @endif
</x-app-layout>
