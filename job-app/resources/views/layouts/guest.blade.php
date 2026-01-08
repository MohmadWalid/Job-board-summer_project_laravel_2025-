{{-- resources/views/layouts/guest.blade.php --}}

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
                <div class="hidden md:flex items-center space-x-6 opacity-0 animate-fade-in-up"
                    style="animation-delay: 0.2s;">
                    <a href="{{ route('login') }}"
                        class="{{ request()->routeIs('login') ? 'text-white font-semibold' : 'text-gray-300 hover:text-white' }} transition-colors duration-300">
                        Login
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="px-6 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white rounded-lg font-medium transition-all duration-300 transform hover:scale-105 hover:shadow-lg">
                            Sign Up
                        </a>
                    @endif
                </div>
            </div>
        </nav>

        <!-- Main Content Area for Forms -->
        <main class="flex-1 flex items-center justify-center px-6 py-12 lg:px-12">
            <div class="w-full max-w-md">
                <div class="opacity-0 animate-fade-in-up space-y-8">
                    {{ $slot }}
                </div>
            </div>
        </main>

        <!-- Mobile Bottom Navigation -->
        <div class="md:hidden fixed bottom-0 left-0 right-0 glass-effect border-t border-gray-800 px-6 py-4">
            <div class="flex items-center justify-around gap-3">
                <a href="{{ route('login') }}"
                    class="flex-1 px-6 py-2.5 {{ request()->routeIs('login') ? 'bg-gradient-to-r from-indigo-600 to-purple-600' : 'glass-effect' }} text-white rounded-lg font-medium text-center transition-all">
                    Login
                </a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="flex-1 px-6 py-2.5 bg-gradient-to-r from-indigo-600 to-purple-600 text-white rounded-lg font-medium text-center transition-all transform hover:scale-105">
                        Sign Up
                    </a>
                @endif
            </div>
        </div>
    </div>
</x-main-layout>
