<div class="p-6">
    <!-- Header section with company name -->
    <div class="flex justify-between items-center mb-6">
        <h3 class="text-xl font-semibold text-gray-900">Job Applications for {{ $company->name }}
            <span
                class="ml-3 inline-flex items-center px-3 py-1 rounded-full text-lg font-semibold bg-indigo-100 text-indigo-800">
                {{ $company->job_applications->count() }}
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
                @forelse ($company->job_applications as $application)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $application->user->name ?? 'N/A' }}
                            <div class="text-sm text-gray-500">
                                {{ $application->user->email ?? 'N/A' }}
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
                        <x-icons.view-icon href="{{ route('job-applications.show', $application->id) }}" />
                    </tr>
                    @empty
                        <!-- Empty state message -->
                        <tr>
                            <td colspan="5" class="px-6 py-12 text-center">
                                <div class="max-w-md mx-auto">
                                    <svg class="mx-auto h-16 w-16 text-gray-300" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                            d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                                    </svg>
                                    <p class="mt-4 text-lg font-medium text-gray-900">No applications yet
                                    </p>
                                    <p class="text-sm text-gray-500">Candidates will appear here once they
                                        apply.</p>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
