<div class="p-6">
    <!-- Header section with company name and add job button -->
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-xl font-semibold text-gray-900">Jobs at {{ $company->name }}
            <span
                class="ml-3 inline-flex items-center px-3 py-1 rounded-full text-lg font-semibold bg-indigo-100 text-indigo-800">
                {{ $company->job_vacancies->count() }}
            </span>
        </h3>

        {{-- Add New Job Button  --}}
        <x-buttons.add-button href="{{ route('job-vacancies.create', ['company_id' => $company->id]) }}">
            Add New Job
        </x-buttons.add-button>

    </div>

    <!-- Scrollable table container for job vacancies -->
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <!-- Table header row -->
                <tr>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Title
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Created at
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Type
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Location
                    </th>
                    <th scope="col"
                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                        Action
                    </th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <!-- Loop through job vacancies -->
                @forelse ($company->job_vacancies as $job)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $job->title }}
                        </td>

                        <!-- Created Date -->
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                            <div>{{ $job->created_at->format('M d, Y') }}</div>
                            <div class="text-xs text-gray-400">
                                {{ $job->created_at->diffForHumans() }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $job->title }}
                        </td>
                        <!-- Job Type Badge with Color Coding -->
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            @switch($job->type)
                                @case('full-time')
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-blue-100 text-blue-800">
                                        {{ $job->type }}
                                    </span>
                                @break

                                @case('contract')
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-orange-100 text-orange-800">
                                        {{ $job->type }}
                                    </span>
                                @break

                                @case('remote')
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                                        {{ $job->type }}
                                    </span>
                                @break

                                @case('hybrid')
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-pink-100 text-pink-800">
                                        {{ $job->type }}
                                    </span>
                                @break

                                @default
                                    <span
                                        class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                        {{ $job->type }}
                                    </span>
                            @endswitch
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $job->location ?? 'N/A' }}
                        </td>
                        <!-- View icon -->
                        <x-icons.view-icon href="{{ route('job-vacancies.show', $job->id) }}" />
                    </tr>
                    @empty
                        <!-- Empty state message -->
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="max-w-md mx-auto">
                                    <!-- Icon -->
                                    <div
                                        class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-gray-100">
                                        <svg class="h-12 w-12 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <p class="mt-4 text-lg font-medium text-gray-900">No job vacancies created yet
                                    </p>
                                    <p class="text-sm text-gray-500">Create a job vacancy to start receiving applications.
                                    </p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
