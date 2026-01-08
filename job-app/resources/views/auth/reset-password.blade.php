{{-- resources/views/auth/reset-password.blade.php --}}

<x-guest-layout>
    <div class="glass-effect rounded-2xl p-8 lg:p-12 shadow-2xl border border-gray-800/50">
        <div class="text-center mb-10">
            <h2 class="text-4xl font-bold leading-tight">
                Reset Password
            </h2>
            <p class="text-gray-400 mt-4 text-lg">
                Enter your email and choose a new secure password
            </p>
        </div>

        <form method="POST" action="{{ route('password.store') }}" class="space-y-6">
            @csrf

            <!-- Password Reset Token -->
            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" class="text-gray-300 font-medium" />
                <x-text-input id="email"
                    class="block mt-2 w-full px-5 py-4 glass-effect border border-gray-700/50 rounded-xl focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30 transition-all"
                    type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username"
                    placeholder="you@example.com" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <x-input-label for="password" :value="__('New Password')" class="text-gray-300 font-medium" />
                <x-text-input id="password"
                    class="block mt-2 w-full px-5 py-4 glass-effect border border-gray-700/50 rounded-xl focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30 transition-all"
                    type="password" name="password" required autocomplete="new-password" placeholder="••••••••" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div>
                <x-input-label for="password_confirmation" :value="__('Confirm New Password')" class="text-gray-300 font-medium" />
                <x-text-input id="password_confirmation"
                    class="block mt-2 w-full px-5 py-4 glass-effect border border-gray-700/50 rounded-xl focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/30 transition-all"
                    type="password" name="password_confirmation" required autocomplete="new-password"
                    placeholder="••••••••" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex items-center justify-center mt-8">
                <button type="submit"
                    class="px-8 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold rounded-xl transition-all duration-300 transform hover:scale-105 hover:shadow-2xl">
                    {{ __('Reset Password') }}
                </button>
            </div>
        </form>
    </div>
</x-guest-layout>
