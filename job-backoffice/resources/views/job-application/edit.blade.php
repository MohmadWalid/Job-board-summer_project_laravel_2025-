<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <!-- Back Button -->
            <x-buttons.back-button
                href="{{ request()->query('redirect') == 'show'
                    ? route('job-applications.show', $jobApplication->id)
                    : route('job-applications.index') }}">
                Back
            </x-buttons.back-button>

            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit Application Status
            </h2>

            <div class="w-24"></div> <!-- Spacer for alignment -->
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Edit Form Card -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <form action="{{ route('job-applications.update', $jobApplication->id) }}" method="POST" class="p-6">
                    @csrf
                    @method('PUT')

                    {{-- Add this hidden input to preserve the redirect parameter --}}
                    <input type="hidden" name="redirect" value="{{ request()->query('redirect', 'index') }}">

                    <h3 class="text-xl font-bold mb-6 text-gray-900">Application Details</h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-4 gap-y-6">

                        <!-- Applicant (View Only) -->
                        <div>
                            <dt class="text-sm font-medium text-gray-500 mb-1">Applicant</dt>
                            <dd class="text-sm text-gray-900 font-medium">{{ $jobApplication->user->name }}</dd>
                            <div class="text-sm text-gray-500">{{ $jobApplication->user->email ?? 'N/A' }}</div>
                        </div>

                        <!-- Job Vacancy (View Only) -->
                        <div>
                            <dt class="text-sm font-medium text-gray-500 mb-1">Job Vacancy</dt>
                            <dd class="text-sm text-gray-900">
                                <a href="{{ route('job-vacancies.show', $jobApplication->job_vacancy->id) }}"
                                    target="_blank" rel="noopener noreferrer"
                                    class="text-indigo-600 hover:text-indigo-900 hover:underline transition-colors duration-200">
                                    {{ $jobApplication->job_vacancy->title }}
                                </a>
                            </dd>
                        </div>

                        <!-- Company (View Only) -->
                        <div>
                            <dt class="text-sm font-medium text-gray-500 mb-1">Company</dt>
                            <dd class="text-sm text-gray-900">
                                <a href="{{ route('companies.show', $jobApplication->job_vacancy->company_id) }}"
                                    target="_blank" rel="noopener noreferrer"
                                    class="text-indigo-600 hover:text-indigo-900 hover:underline transition-colors duration-200">
                                    {{ $jobApplication->job_vacancy->company->name }}
                                </a>
                            </dd>
                        </div>

                        <!-- Status (Editable) -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-500 mb-2">
                                Status <span class="text-red-500">*</span>
                            </label>
                            <select id="status" name="status"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm @error('status') border-red-300 @enderror">
                                <option value="" disabled>Select Status</option>
                                <option value="Pending"
                                    {{ old('status', $jobApplication->status) == 'Pending' ? 'selected' : '' }}>
                                    Pending
                                </option>
                                <option value="Accepted"
                                    {{ old('status', $jobApplication->status) == 'Accepted' ? 'selected' : '' }}>
                                    Accepted
                                </option>
                                <option value="Rejected"
                                    {{ old('status', $jobApplication->status) == 'Rejected' ? 'selected' : '' }}>
                                    Rejected
                                </option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>

                    <!-- Form Actions -->
                    <div class="mt-8 flex items-center justify-end space-x-4">
                        <x-buttons.back-button
                            href="{{ request()->query('redirect') == 'show'
                                ? route('job-applications.show', $jobApplication->id)
                                : route('job-applications.index') }}">
                            Back
                        </x-buttons.back-button>

                        {{-- Update Button --}}
                        <x-buttons.submit-button>Update Job Application</x-buttons.submit-button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
