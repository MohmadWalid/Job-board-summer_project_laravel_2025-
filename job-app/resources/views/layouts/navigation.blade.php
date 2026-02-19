{{-- resources/views/layouts/navigation.blade.php --}}

<nav class="w-full glass-effect border-b border-gray-800 px-6 py-6 lg:px-12">
    <div class="max-w-7xl mx-auto flex items-center justify-between">
        <!-- Logo -->
        <div class="flex items-center space-x-3 opacity-0 animate-fade-in-up">
            <a href="{{ route('dashboard') }}" class="flex items-center space-x-3">
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

        <!-- Navigation Links -->
        <div class="hidden md:flex items-center space-x-8 opacity-0 animate-fade-in-up" style="animation-delay: 0.2s;">
            <a href="{{ route('dashboard') }}"
                class="{{ request()->routeIs('dashboard') ? 'text-white font-semibold' : 'text-gray-300 hover:text-white' }} transition-colors duration-300">
                Dashboard
            </a>
            <a href="{{ route('job-applications.index') }}"
                class="{{ request()->routeIs('job-applications*') ? 'text-white font-semibold' : 'text-gray-300 hover:text-white' }} transition-colors duration-300">
                My Applications
            </a>

            <!-- User Dropdown -->
            <div class="relative" x-data="{ open: false }">
                <button @click="open = !open"
                    class="flex items-center space-x-3 text-gray-300 hover:text-white transition-colors">
                    <span class="font-medium">{{ Auth::user()->name }}</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <!-- Dropdown Menu -->
                <div x-show="open" @click.outside="open = false" x-transition
                    class="absolute right-0 mt-4 w-56 rounded-xl bg-gray-800 shadow-2xl border border-gray-700 overflow-hidden z-50">

                    <div class="py-1">
                        <!-- Profile Link with Icon -->
                        <a href="{{ route('profile.edit') }}"
                            class="group flex items-center px-4 py-3 text-sm text-gray-300 hover:bg-gray-700/50 hover:text-white transition-all duration-200">
                            <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-white" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                            Profile
                        </a>

                        <!-- Logout Link with Icon (RED HOVER) -->
                        <a href="{{ route('logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                            class="group flex items-center px-4 py-3 text-sm text-gray-300 hover:text-red-400 hover:bg-red-500/10 transition-all duration-200 cursor-pointer">
                            <svg class="w-5 h-5 mr-3 text-gray-400 group-hover:text-red-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            Log Out
                        </a>
                    </div>

                    <!-- Hidden Logout Form -->
                    <form id="logout-form" method="POST" action="{{ route('logout') }}" class="hidden">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>
