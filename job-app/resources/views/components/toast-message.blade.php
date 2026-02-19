<!-- Flash Messages (Success + Error) -->
@if (session('success') || session('error') || session('errors')?->any())
    <div x-data="{ show: true }" x-show="show" x-transition:enter="transition ease-out duration-400"
        x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0" x-init="setTimeout(() => show = false, {{ session('success') ? 4000 : 5000 }})"
        class="mb-6 rounded-xl border px-6 py-4 shadow-lg relative"
        :class="{
            'bg-green-50 border-green-400 text-green-800': '{{ session('success') }}',
            'bg-red-50 border-red-400 text-red-800': '{{ session('error') }}' || '{{ session('errors')?->first() }}'
        }"
        role="alert">
        <!-- Message Content -->
        <div class="flex items-center">
            <!-- Icon -->
            <svg x-show="'{{ session('success') }}'" class="w-6 h-6 mr-3 flex-shrink-0 text-green-600"
                fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                    clip-rule="evenodd" />
            </svg>

            <svg x-show="! '{{ session('success') }}'" class="w-6 h-6 mr-3 flex-shrink-0 text-red-600"
                fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z"
                    clip-rule="evenodd" />
            </svg>

            <!-- Text -->
            <span class="block sm:inline font-medium">
                {{ session('success') ?? (session('error') ?? session('errors')?->first()) }}
            </span>
        </div>

        <!-- Close Button -->
        <button @click="show = false" class="absolute top-0 bottom-0 right-0 px-4 py-3 focus:outline-none"
            aria-label="Close">
            <svg class="h-6 w-6"
                :class="{
                    'text-green-600': '{{ session('success') }}',
                    'text-red-600': !'{{ session('success') }}'
                }"
                fill="currentColor" viewBox="0 0 20 20">
                <path
                    d="M14.348 14.849a1.2 1.2 0 01-1.697 0L10 11.897l-2.651 2.952a1.2 1.2 0 11-1.697-1.697L8.303 10l-2.951-2.651a1.2 1.2 0 011.697-1.697L10 8.303l2.651-2.951a1.2 1.2 0 011.697 1.697L11.697 10l2.951 2.651a1.2 1.2 0 010 1.698z" />
            </svg>
        </button>
    </div>
@endif
