{{-- resources/views/auth/verify-email.blade.php --}}

<x-guest-layout>
    <div class="glass-effect rounded-2xl p-8 lg:p-12 shadow-2xl border border-gray-800/50">
        <div class="text-center mb-10">
            <h2 class="text-4xl font-bold leading-tight">
                Verify Your Email
            </h2>
            <p class="text-gray-400 mt-4 text-lg max-w-lg mx-auto">
                {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
            </p>
        </div>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-8 text-center">
                <p class="text-green-500 font-medium text-lg">
                    {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                </p>
            </div>
        @endif

        <div class="flex flex-col sm:flex-row items-center justify-center gap-6 mt-8">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf
                <button type="submit"
                    class="px-8 py-4 bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-700 hover:to-purple-700 text-white font-semibold rounded-xl transition-all duration-300 transform hover:scale-105 hover:shadow-2xl">
                    {{ __('Resend Verification Email') }}
                </button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit"
                    class="text-gray-400 hover:text-white underline-offset-4 hover:underline transition-colors font-medium">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>
