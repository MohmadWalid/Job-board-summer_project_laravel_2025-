<x-main-layout>
    <div class="min-h-screen flex flex-col">
        <!-- Navigation -->
        <nav class="w-full px-6 py-6 lg:px-12">
            <div class="max-w-7xl mx-auto flex items-center justify-between">
                <!-- Logo -->
                <div class="flex items-center space-x-3 opacity-0 animate-fade-in-up">
                    <a href="{{ url('/') }}" class="flex items-center space-x-3">
                        <div
                            class="w-10 h-10 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-lg flex items-center justify-center">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <span class="text-2xl font-bold gradient-text">Shaghlni</span>
                    </a>
                </div>

                <!-- Desktop Navigation -->
                <div class="hidden md:flex items-center space-x-4 opacity-0 animate-fade-in-up"
                    style="animation-delay: 0.2s;">
                    @auth
                        <a href="{{ url('/dashboard') }}"
                            class="px-6 py-2.5 text-gray-300 hover:text-white transition-colors duration-300">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}"
                            class="px-6 py-2.5 text-gray-300 hover:text-white transition-colors duration-300">
                            Login
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="px-6 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white rounded-lg font-medium transition-all duration-300 transform hover:scale-105 hover:shadow-lg">
                                Sign Up
                            </a>
                        @endif
                    @endauth
                </div>
            </div>
        </nav>

        <!-- Hero Section -->
        <main class="flex-1 flex items-center justify-center px-6 py-12 lg:px-12">
            <div class="max-w-7xl mx-auto w-full">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <!-- Left Content -->
                    <div class="space-y-8">
                        <!-- Badge -->
                        <div class="inline-flex items-center space-x-2 glass-effect rounded-full px-4 py-2 opacity-0 animate-fade-in-up"
                            style="animation-delay: 0.1s;">
                            <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                            <span class="text-sm text-gray-300">Now Hiring</span>
                        </div>

                        <!-- Main Heading -->
                        <div class="space-y-4 opacity-0 animate-fade-in-up" style="animation-delay: 0.2s;">
                            <h1 class="text-5xl lg:text-7xl font-bold leading-tight">
                                Find Your
                                <span class="gradient-text block">Dream Job</span>
                            </h1>
                            <p class="text-xl text-gray-400 max-w-lg">
                                Connect with top employers, discover exciting opportunities, and take the next step in
                                your career journey.
                            </p>
                        </div>

                        <!-- CTA Buttons -->
                        <div class="flex flex-col sm:flex-row gap-4 opacity-0 animate-fade-in-up"
                            style="animation-delay: 0.3s;">
                            @auth
                                <a href="{{ url('/dashboard') }}"
                                    class="group px-8 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 hover:shadow-2xl text-center">
                                    Go to Dashboard
                                    <svg class="inline-block w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                    </svg>
                                </a>
                            @else
                                <a href="{{ route('register') }}"
                                    class="group px-8 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white rounded-xl font-semibold transition-all duration-300 transform hover:scale-105 hover:shadow-2xl text-center">
                                    Get Started
                                    <svg class="inline-block w-5 h-5 ml-2 group-hover:translate-x-1 transition-transform"
                                        fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 7l5 5m0 0l-5 5m5-5H6" />
                                    </svg>
                                </a>
                                <a href="{{ route('login') }}"
                                    class="px-8 py-4 glass-effect hover:bg-gray-800 text-white rounded-xl font-semibold transition-all duration-300 text-center">
                                    Sign In
                                </a>
                            @endauth
                        </div>

                        <!-- Stats -->
                        <div class="grid grid-cols-3 gap-6 pt-8 opacity-0 animate-fade-in-up"
                            style="animation-delay: 0.4s;">
                            <div class="space-y-1">
                                <div class="text-3xl font-bold gradient-text">50K+</div>
                                <div class="text-sm text-gray-400">Active Jobs</div>
                            </div>
                            <div class="space-y-1">
                                <div class="text-3xl font-bold gradient-text">30K+</div>
                                <div class="text-sm text-gray-400">Companies</div>
                            </div>
                            <div class="space-y-1">
                                <div class="text-3xl font-bold gradient-text">100K+</div>
                                <div class="text-sm text-gray-400">Job Seekers</div>
                            </div>
                        </div>
                    </div>

                    <!-- Right Illustration -->
                    <div class="hidden lg:block relative opacity-0 animate-fade-in-up" style="animation-delay: 0.5s;">
                        <div class="relative">
                            <!-- Decorative Cards -->
                            <div
                                class="absolute top-0 right-0 w-72 glass-effect rounded-2xl p-6 transform rotate-6 hover:rotate-0 transition-transform duration-500">
                                <div class="flex items-center space-x-4 mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-br from-indigo-600 to-purple-600 rounded-lg">
                                    </div>
                                    <div class="flex-1">
                                        <div class="h-3 bg-gray-700 rounded w-3/4 mb-2"></div>
                                        <div class="h-2 bg-gray-800 rounded w-1/2"></div>
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <div class="h-2 bg-gray-800 rounded"></div>
                                    <div class="h-2 bg-gray-800 rounded w-5/6"></div>
                                </div>
                            </div>

                            <div class="absolute bottom-0 left-0 w-72 glass-effect rounded-2xl p-6 transform -rotate-6 hover:rotate-0 transition-transform duration-500"
                                style="top: 200px;">
                                <div class="flex items-center space-x-4 mb-4">
                                    <div class="w-12 h-12 bg-gradient-to-br from-pink-600 to-orange-600 rounded-lg">
                                    </div>
                                    <div class="flex-1">
                                        <div class="h-3 bg-gray-700 rounded w-3/4 mb-2"></div>
                                        <div class="h-2 bg-gray-800 rounded w-1/2"></div>
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <div class="h-2 bg-gray-800 rounded"></div>
                                    <div class="h-2 bg-gray-800 rounded w-5/6"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Mobile Navigation (Bottom) -->
        <div class="md:hidden fixed bottom-0 left-0 right-0 glass-effect border-t border-gray-800 px-6 py-4">
            <div class="flex items-center justify-around">
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="px-6 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-lg font-medium text-center flex-1">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="px-6 py-2.5 glass-effect text-white rounded-lg font-medium text-center flex-1 mr-2">
                        Login
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="px-6 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-lg font-medium text-center flex-1 ml-2">
                            Sign Up
                        </a>
                    @endif
                @endauth
            </div>
        </div>
    </div>
</x-main-layout>
