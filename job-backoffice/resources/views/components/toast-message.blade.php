<!-- Success Message -->
@if (session('success'))
    <div x-data="{ show: true }" x-show="show" x-transition:leave="transition ease-in duration-500"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" x-init="setTimeout(() => show = false, 3000)"
        class="bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded-xl relative mb-6 shadow-lg"
        role="alert">
        <span class="block sm:inline font-medium">{{ session('success') }}</span>
        <span class="absolute top-0 bottom-0 right-0 px-4 py-3 cursor-pointer" @click="show = false">
            <svg class="fill-current h-6 w-6 text-green-500" role="button" xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20">
                <title>Close</title>
                <path
                    d="M14.348 14.849a1.2 1.2 0 01-1.697 0L10 11.897l-2.651 2.952a1.2 1.2 0 11-1.697-1.697L8.303 10l-2.951-2.651a1.2 1.2 0 011.697-1.697L10 8.303l2.651-2.951a1.2 1.2 0 011.697 1.697L11.697 10l2.951 2.651a1.2 1.2 0 010 1.698z" />
            </svg>
        </span>
    </div>
@endif
