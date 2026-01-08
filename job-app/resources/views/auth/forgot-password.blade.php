{{-- resources/views/auth/forgot-password.blade.php --}}

<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="glass-effect rounded-2xl p-8 lg:p-12 shadow-2xl border border-gray-800/50">
        <div class="text-center mb-10">
            <h2 class="text-4xl font-bold leading-tight">
                Forgot Password?
            </h2>
            <p class="text-gray-400 mt-4 text-lg max-w-md mx-auto">
                {{ __('No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </p>
        </div>

        <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
            @csrf

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" class="text-gray-300 font-medium" />
                <x-text-input id="email"
                    class="block mt-2 w-full px-5 py-4 glass-effect border border-gray-700/50 rounded-xl focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30 transition-all"
                    type="email" name="email" :value="old('email')" required autofocus placeholder="you@example.com" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="flex items-center justify-center mt-8">
                <button type="submit"
                    class="px-8 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold rounded-xl transition-all duration-300 transform hover:scale-105 hover:shadow-2xl">
                    {{ __('Email Password Reset Link') }}
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>
