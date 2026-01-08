<div class="p-6 bg-gradient-to-br from-gray-50 to-white">
    <!-- Header section -->
    <div class="flex justify-between items-center mb-12">
        <div>
            <h3 class="text-3xl font-bold text-gray-900">AI Feedback</h3>
            <p class="text-sm text-gray-500 mt-1">Automated analysis and recommendations</p>
        </div>
    </div>

    <!-- Card-based layout matching Resume tab style -->
    <div class="grid grid-cols-1 gap-6">

        <!-- AI Score Card -->
        <div
            class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow duration-200">
            <div class="flex items-start space-x-3">
                <div class="flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                        stroke="none">
                        <title>Score Metrics Chart</title>
                        <rect x="3" y="3" width="18" height="18" fill="#f0f0f0" rx="1" />

                        <rect x="5" y="15" width="4" height="6" fill="#4ade80" rx="1" />

                        <rect x="10" y="11" width="4" height="10" fill="#3b82f6" rx="1" />

                        <rect x="15" y="7" width="4" height="14" fill="#ef4444" rx="1" />

                        <line x1="3" y1="21" x2="21" y2="21" stroke="#333"
                            stroke-width="1" />
                    </svg>
                </div>
                <div class="flex-1">
                    <h4 class="text-sm font-semibold text-gray-900 uppercase tracking-wide mb-2">AI Score</h4>

                    {{-- Display score or empty state --}}
                    @if ($jobApplication->ai_generated_score ?? false)
                        <div class="flex items-center space-x-4">
                            <div
                                class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-indigo-100 border-2 border-indigo-200">
                                <span class="text-2xl font-bold text-indigo-600">
                                    {{ $jobApplication->ai_generated_score }}
                                </span>
                            </div>
                            <p class="text-sm text-gray-600">Overall Match Score</p>
                        </div>
                    @else
                        <p class="text-gray-500 italic">No score available</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- AI Feedback Card -->
        <div
            class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 hover:shadow-md transition-shadow duration-200">
            <div class="flex items-start space-x-3">
                <div class="flex-shrink-0">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="none"
                        stroke="none">
                        <title>Gradient Comment/Score Bubble</title>

                        <defs>
                            <linearGradient id="gradientBubble" x1="0%" y1="0%" x2="100%"
                                y2="100%">
                                <stop offset="0%" style="stop-color:#a855f7;stop-opacity:1" />
                                <stop offset="100%" style="stop-color:#ec4899;stop-opacity:1" />
                            </linearGradient>
                        </defs>

                        <path fill="url(#gradientBubble)"
                            d="M21 4c1.1 0 2 .9 2 2v8c0 1.1-.9 2-2 2h-5.17l-4.98 4.98c-.19.19-.45.29-.7.29s-.51-.1-.71-.29L10.17 16H3c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2h18z" />

                        <circle cx="8" cy="10" r="1" fill="#ffffff" />
                        <circle cx="12" cy="10" r="1" fill="#ffffff" />
                        <circle cx="16" cy="10" r="1" fill="#ffffff" />
                    </svg>
                </div>
                <div class="flex-1">
                    <h4 class="text-sm font-semibold text-gray-900 uppercase tracking-wide mb-2">AI Feedback</h4>

                    {{-- Display feedback or empty state --}}
                    @if ($jobApplication->ai_generated_feedback ?? false)
                        <p class="text-gray-700 leading-relaxed">{{ $jobApplication->ai_generated_feedback }}</p>
                    @else
                        <p class="text-gray-500 italic">No feedback available</p>
                    @endif
                </div>
            </div>
        </div>

    </div>
</div>
