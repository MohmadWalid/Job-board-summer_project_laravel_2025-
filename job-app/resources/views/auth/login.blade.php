{{-- resources/views/auth/login.blade.php --}}

<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="glass-effect rounded-2xl p-8 lg:p-12 shadow-2xl border border-gray-800/50">
        <div class="text-center mb-10">
            <h2 class="text-4xl font-bold leading-tight">
                Welcome Back
            </h2>
            <p class="text-gray-400 mt-3 text-lg">
                Sign in to access your dashboard
            </p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" class="text-gray-300 font-medium" />
                <x-text-input id="email"
                    class="block mt-2 w-full px-5 py-4 glass-effect border border-gray-700/50 rounded-xl focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30 transition-all"
                    type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                    placeholder="you@example.com" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('Password')" class="text-gray-300 font-medium" />
                <x-text-input id="password"
                    class="block mt-2 w-full px-5 py-4 glass-effect border border-gray-700/50 rounded-xl focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30 transition-all"
                    type="password" name="password" required autocomplete="current-password" placeholder="••••••••" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between">
                <label for="remember_me" class="flex items-center cursor-pointer">
                    <input id="remember_me" type="checkbox"
                        class="w-5 h-5 rounded border-gray-600 bg-gray-800 text-indigo-600 focus:ring-indigo-500 focus:ring-offset-gray-900"
                        name="remember">
                    <span class="ml-3 text-gray-300">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="mt-8 space-y-6">
                <!-- Register Link - Centered on mobile, left on desktop -->
                <div class="text-center sm:text-left">
                    <a href="{{ route('register') }}" class="text-gray-400 hover:text-white transition-colors">
                        {{ __("Don't have an account?") }}
                        <span class="underline font-medium ml-1">Register</span>
                    </a>
                </div>

                <!-- Log in Button - Full width on mobile, auto on desktop -->
                <div class="flex justify-center sm:justify-end">
                    <button type="submit"
                        class="px-8 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold rounded-xl transition-all duration-300 transform hover:scale-105 hover:shadow-2xl w-full sm:w-auto max-w-sm">
                        {{ __('Log in') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
</x-guest-layout>
