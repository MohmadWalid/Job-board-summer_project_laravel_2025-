<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if (request()->has('archived'))
                {{ __('Archived Job Applications') }}
            @else
                {{ __('Job Applications') }}
                <span
                    class="ml-3 inline-flex items-center px-3 py-1 rounded-full text-lg font-semibold bg-indigo-100 text-indigo-800">
                    {{ $jobApplications->total() }}
                </span>
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <x-toast-message />

            <div class="flex justify-between items-center py-8">
                <!-- Active and Archived buttons -->
                <x-status-toggle route-Name="job-applications.index" active-Label="Active Applications"
                    archived-Label="Archived Applications" />
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Applicant Name
                                    </th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Position (Job Vacancy)
                                    </th>
                                    @if (Auth::user()->rule == 'admin')
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Company
                                        </th>
                                    @endif
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status
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
                                @forelse ($jobApplications as $jobApplication)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            @if (!request()->has('archived'))
                                                <a href="{{ route('job-applications.show', $jobApplication->id) }}"
                                                    class="text-indigo-600 hover:text-indigo-900 hover:underline transition-colors duration-200">
                                                    {{ $jobApplication->user->name }}
                                                </a>
                                                <div class="text-sm text-gray-500">
                                                    {{ $jobApplication->user->email ?? 'N/A' }}
                                                </div>
                                            @else
                                                <span class="text-gray-900"> {{ $jobApplication->user->name }} </span>
                                                <div class="text-sm text-gray-500">
                                                    {{ $jobApplication->user->email ?? 'N/A' }}
                                                </div>
                                            @endif
                                        </td>

                                        {{-- Position --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $jobApplication->job_vacancy->title ?? 'N/A' }}
                                        </td>

                                        @if (Auth::user()->rule == 'admin')
                                            {{-- Company --}}
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                @if (!request()->has('archived'))
                                                    <a href="{{ route('companies.show', $jobApplication->job_vacancy->company->id) }}"
                                                        class="text-indigo-600 hover:text-indigo-900 hover:underline transition-colors duration-200">
                                                        {{ $jobApplication->job_vacancy->company->name }}
                                                    </a>
                                                @else
                                                    <span> {{ $jobApplication->job_vacancy->company->name }} </span>
                                                @endif
                                            </td>
                                        @endif

                                        <!-- Status Row with color coding -->
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
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
                                        </td>

                                        {{-- Edit Button --}}
                                        @if (!request()->has('archived'))
                                            <x-icons.edit-icon
                                                href="{{ route('job-applications.edit', ['job_application' => $jobApplication->id, 'redirect' => 'index']) }}" />
                                        @endif

                                        {{-- Archive/Restore Button --}}
                                        <td class="px-10 py-4 whitespace-nowrap text-sm text-gray-500">
                                            @if (request()->has('archived'))
                                                <x-icons.restore-icon
                                                    action="{{ route('job-applications.restore', $jobApplication->id) }}" />
                                            @else
                                                <x-icons.archive-icon
                                                    action="{{ route('job-applications.destroy', $jobApplication->id) }}" />
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                        <!-- Empty State – No Job applications -->
                                        <tr>
                                            <td colspan="8" class="py-20 text-center align-middle">
                                                <div class="max-w-md mx-auto">
                                                    <!-- Icon -->
                                                    <div
                                                        class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-gray-100">
                                                        <svg class="mx-auto h-16 w-16 text-gray-300" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="1.5"
                                                                d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                                                        </svg>
                                                    </div>

                                                    <!-- Title -->
                                                    <h3 class="mt-6 text-xl font-semibold text-gray-900">
                                                        @if (request()->has('archived'))
                                                            No archived applications
                                                        @else
                                                            No active applications yet
                                                        @endif
                                                    </h3>

                                                    <!-- Subtitle -->
                                                    <p class="mt-3 text-sm text-gray-500 leading-relaxed max-w-xs mx-auto">
                                                        @if (request()->has('archived'))
                                                            All active applications appear in the main list.
                                                            <br>Applications are moved here once they are archived.
                                                        @else
                                                            Candidates will appear here once they apply to one of your
                                                            active job vacancies.
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
                    {{ $jobApplications->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </x-app-layout>
