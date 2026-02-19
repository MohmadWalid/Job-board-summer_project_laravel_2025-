<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between flex-wrap gap-4">
            <!-- Back Button -->
            <x-back-button href="{{ route('job-vacancies.show', $jobVacancy) }}">
                Back to Job Details
            </x-back-button>

            <h2 class="font-semibold text-xl text-gray-100 leading-tight flex-1 text-center md:text-left">
                Apply for {{ $jobVacancy->title }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <x-toast-message />
            <!-- Job Quick Info Card -->
            <div class="glass-effect rounded-2xl overflow-hidden shadow-xl mb-8 border border-gray-800">
                <div class="p-6">
                    <div class="flex items-start gap-4">
                        <!-- Company Logo Placeholder -->
                        <div
                            class="w-16 h-16 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-xl flex items-center justify-center flex-shrink-0">
                            <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                        </div>

                        <!-- Job Info -->
                        <div class="flex-1">
                            <h3 class="text-2xl font-bold text-gray-100 mb-2">{{ $jobVacancy->title }}</h3>
                            <p class="text-gray-400 mb-3">{{ $jobVacancy->company->name }}</p>

                            <div class="flex flex-wrap gap-3">
                                <!-- Location Badge -->
                                <span
                                    class="inline-flex items-center px-3 py-1 bg-gray-800 text-gray-300 rounded-lg text-sm">
                                    <svg class="w-4 h-4 mr-1.5" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    </svg>
                                    {{ $jobVacancy->location }}
                                </span>

                                <!-- Job Type Badge -->
                                @php
                                    $badgeClasses = match ($jobVacancy->type) {
                                        'full-time' => 'bg-green-600',
                                        'contract' => 'bg-blue-600',
                                        'remote' => 'bg-purple-600',
                                        'hybrid' => 'bg-yellow-600',
                                        default => 'bg-gray-600',
                                    };
                                @endphp
                                <span
                                    class="inline-flex items-center px-3 py-1 {{ $badgeClasses }} text-white rounded-lg text-sm font-medium">
                                    {{ ucfirst(str_replace('-', ' ', $jobVacancy->type)) }}
                                </span>

                                <!-- Salary Badge (if available) -->
                                @if ($jobVacancy->salary)
                                    <span
                                        class="inline-flex items-center px-3 py-1 bg-emerald-600 text-white rounded-lg text-sm font-medium">
                                        ${{ number_format($jobVacancy->salary, 0) }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Application Form -->
            <form action="{{ route('job-vacancies.storeApplication', $jobVacancy) }}" method="POST"
                enctype="multipart/form-data" x-data="{
                    resumeOption: 'existing',
                    file: null,
                    fileName: '',
                    fileSize: '',
                    error: '',
                    isDragging: false,

                    validateFile(file) {
                        this.error = '';
                        if (file.type !== 'application/pdf') {
                            this.error = 'Please upload a PDF file only';
                            return false;
                        }
                        const maxSize = 5 * 1024 * 1024;
                        if (file.size > maxSize) {
                            this.error = 'File size exceeds 5MB limit';
                            return false;
                        }
                        return true;
                    },

                    handleFile(file) {
                        if (this.validateFile(file)) {
                            this.file = file;
                            this.fileName = file.name;
                            this.fileSize = (file.size / 1024 / 1024).toFixed(2) + ' MB';
                        }
                    },

                    clearFile() {
                        this.file = null;
                        this.fileName = '';
                        this.fileSize = '';
                        this.error = '';
                        $refs.fileInput.value = '';
                    }
                }">
                @csrf
                <input type="hidden" name="job_vacancy_id" value="{{ $jobVacancy->id }}">

                <!-- Resume Selection Section -->
                <div class="glass-effect rounded-2xl overflow-hidden shadow-xl mb-6 border border-gray-800">
                    <div class="p-6">
                        <div class="flex items-center gap-3 mb-4">
                            <div
                                class="w-10 h-10 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-100">Choose Your Resume</h3>
                        </div>

                        <!-- Resume Options -->
                        <div class="space-y-3">
                            <!-- Option 1: Select Existing Resume -->
                            @if ($resumes->count() > 0)
                                <label class="relative block cursor-pointer">
                                    <input type="radio" name="resume_option" value="existing" x-model="resumeOption"
                                        class="peer sr-only" checked>
                                    <div
                                        class="p-4 bg-gray-900/50 border-2 border-gray-700 rounded-xl hover:border-indigo-600 peer-checked:border-indigo-600 peer-checked:bg-indigo-600/10 transition-all duration-300">
                                        <div class="flex items-center justify-between">
                                            <div class="flex items-center gap-3">
                                                <svg class="w-5 h-5 text-gray-400 peer-checked:text-indigo-400"
                                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                                <span class="font-medium text-gray-200">Use existing resume</span>
                                            </div>
                                        </div>

                                        <!-- Existing Resumes Dropdown -->
                                        <div x-show="resumeOption === 'existing'" x-cloak class="mt-3">
                                            <select name="existing_resume_id"
                                                class="w-full px-4 py-2.5 bg-gray-800 border border-gray-700 rounded-lg text-gray-200 focus:border-indigo-600 focus:ring-2 focus:ring-indigo-600/20 transition-colors"
                                                :required="resumeOption === 'existing'">
                                                <option value="">Select a resume...</option>
                                                @foreach ($resumes as $resume)
                                                    <option value="{{ $resume->id }}">
                                                        {{ $resume->title ?? $resume->file_name }}
                                                        - Updated {{ $resume->updated_at->format('M Y') }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </label>
                            @else
                                <!-- No Resumes Available Message -->
                                <div class="p-4 bg-yellow-900/20 border-2 border-yellow-600/50 rounded-xl">
                                    <div class="flex items-start gap-3">
                                        <svg class="w-5 h-5 text-yellow-400 flex-shrink-0 mt-0.5" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                        </svg>
                                        <div>
                                            <p class="font-medium text-yellow-200">No saved resumes found</p>
                                            <p class="text-sm text-yellow-300/80 mt-1">Please upload a new resume to
                                                apply for this position.</p>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Option 2: Upload New Resume -->
                            <label class="relative block cursor-pointer">
                                <input type="radio" name="resume_option" value="new" x-model="resumeOption"
                                    class="peer sr-only" {{ $resumes->count() === 0 ? 'checked' : '' }}>
                                <div
                                    class="p-4 bg-gray-900/50 border-2 border-gray-700 rounded-xl hover:border-indigo-600 peer-checked:border-indigo-600 peer-checked:bg-indigo-600/10 transition-all duration-300">
                                    <div class="flex items-center gap-3">
                                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                        </svg>
                                        <span class="font-medium text-gray-200">Upload new resume</span>
                                    </div>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>

                <!-- File Upload Section -->
                <div class="glass-effect rounded-2xl overflow-hidden shadow-xl mb-6 border border-gray-800"
                    x-show="resumeOption === 'new'" x-cloak>
                    <div class="p-6">
                        <div class="flex items-center gap-3 mb-4">
                            <div
                                class="w-10 h-10 bg-gradient-to-br from-purple-600 to-pink-600 rounded-lg flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                </svg>
                            </div>
                            <h3 class="text-lg font-semibold text-gray-100">Upload Resume (PDF)</h3>
                        </div>

                        <!-- Dropzone -->
                        <div class="relative">
                            <input type="file" name="resume" x-ref="fileInput" accept=".pdf" class="hidden"
                                @change="handleFile($event.target.files[0])" :required="resumeOption === 'new'">

                            <label @click="$refs.fileInput.click()"
                                @drop.prevent="isDragging = false; handleFile($event.dataTransfer.files[0])"
                                @dragover.prevent="isDragging = true" @dragleave.prevent="isDragging = false"
                                :class="isDragging ? 'border-indigo-600 bg-indigo-600/10' : 'border-gray-700'"
                                class="block border-2 border-dashed rounded-xl p-8 text-center cursor-pointer hover:border-indigo-600 hover:bg-indigo-600/5 transition-all duration-300">

                                <!-- Upload Placeholder -->
                                <div x-show="!file && !error" class="space-y-3">
                                    <div
                                        class="w-16 h-16 mx-auto bg-gray-800 rounded-full flex items-center justify-center">
                                        <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12" />
                                        </svg>
                                    </div>
                                    <div>
                                        <p class="text-lg font-medium text-gray-200">Drop your PDF here or click to
                                            browse</p>
                                        <p class="text-sm text-gray-500 mt-1">Maximum file size: 5MB</p>
                                    </div>
                                </div>

                                <!-- File Selected State -->
                                <div x-show="file && !error" x-cloak>
                                    <div class="flex items-center justify-center gap-3 text-emerald-400">
                                        <svg class="w-12 h-12" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <div class="text-left">
                                            <p class="font-semibold text-gray-100" x-text="fileName"></p>
                                            <p class="text-sm text-gray-400" x-text="fileSize"></p>
                                        </div>
                                    </div>
                                    <button type="button" @click.stop="clearFile()"
                                        class="mt-3 text-sm text-red-400 hover:text-red-300 underline">
                                        Remove file
                                    </button>
                                </div>

                                <!-- Error State -->
                                <div x-show="error" x-cloak>
                                    <div class="flex items-center justify-center gap-3 text-red-400">
                                        <svg class="w-12 h-12" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        <div class="text-left">
                                            <p class="font-semibold text-gray-100">Upload Failed</p>
                                            <p class="text-sm text-gray-400" x-text="error"></p>
                                        </div>
                                    </div>
                                    <button type="button" @click.stop="clearFile()"
                                        class="mt-3 text-sm text-indigo-400 hover:text-indigo-300 underline">
                                        Try again
                                    </button>
                                </div>
                            </label>
                        </div>

                        <!-- Helper Text -->
                        <p class="mt-3 text-sm text-gray-500">
                            <span class="font-medium">Accepted format:</span> PDF only •
                            <span class="font-medium">Max size:</span> 5MB
                        </p>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="mt-10 sm:mt-12 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
                    <!-- Back Button -->
                    <x-back-button href="{{ route('job-vacancies.show', $jobVacancy) }}">
                        Cancel
                    </x-back-button>

                    <!-- Apply Button -->
                    <button type="submit"
                        class="w-full sm:w-auto px-8 py-4 bg-gradient-to-r from-indigo-600 to-purple-600
                   hover:from-indigo-700 hover:to-purple-700 text-white font-semibold
                   rounded-xl shadow-lg hover:shadow-purple-500/30
                   transition-all duration-300 transform hover:scale-[1.03] active:scale-95
                   flex items-center justify-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>Submit Application</span>
                    </button>
                </div>
            </form>
        </div>
    </div>

    <style>
        .glass-effect {
            background: rgba(17, 24, 39, 0.7);
            backdrop-filter: blur(10px);
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
</x-app-layout>
