<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Create Company') }}
            </h2>
            <div class="flex space-x-4 pr-8">
                <!-- Back Button -->
                <x-buttons.back-button href="{{ route('companies.index') }}">Back</x-back-button>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <form action="{{ route('companies.store') }}" method="POST">
                @csrf
                <!-- Company Details Section -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6 text-gray-900">
                        <h2 class="text-xl font-semibold mb-4">{{ __('Company Details') }}</h2>
                        <!-- Company Name Field -->
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Company Name</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}"
                                class="mt-1 block w-full rounded-md shadow-sm sm:text-sm p-2 transition-colors duration-200
                               {{ $errors->has('name') ? 'border-red-500 focus:ring-red-500' : 'border-gray-300 focus:ring-indigo-500' }} focus:border-indigo-500"
                                placeholder="e.g., Google">
                            @error('name')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Industry Field -->
                        <div class="mb-4">
                            <label for="industry" class="block text-sm font-medium text-gray-700">Industry</label>
                            <div class="relative mt-1">
                                <select name="industry" id="industry"
                                    class="appearance-none w-full rounded-md shadow-sm sm:text-sm p-2 pr-10 transition-colors duration-200
                   {{ $errors->has('industry') ? 'border-red-500 focus:ring-red-500' : 'border-gray-300 focus:ring-indigo-500' }}
                   border focus:border-indigo-500 focus:outline-none focus:ring-2 bg-white cursor-pointer
                   hover:border-indigo-400">
                                    <option value="" disabled {{ old('industry') ? '' : 'selected' }}>Select an
                                        Industry</option>
                                    @foreach ($industries as $industry)
                                        <option value="{{ $industry }}"
                                            {{ old('industry') == $industry ? 'selected' : '' }}>
                                            {{ $industry }}
                                        </option>
                                    @endforeach
                                </select>

                            </div>
                            @error('industry')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Address Field -->
                        <div class="mb-4">
                            <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                            <input type="text" name="address" id="address" value="{{ old('address') }}"
                                class="mt-1 block w-full rounded-lg shadow-sm sm:text-sm p-2 transition-colors duration-200
                               {{ $errors->has('address') ? 'border-red-500 focus:ring-red-500' : 'border-gray-300 focus:ring-indigo-500' }} focus:border-indigo-500"
                                placeholder="e.g., 123 Main St, Anytown USA">
                            @error('address')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Website Field -->
                        <div class="mb-4">
                            <label for="website" class="block text-sm font-medium text-gray-700">Website
                                (Optional)</label>
                            <input type="text" name="website" id="website" value="{{ old('website') }}"
                                class="mt-1 block w-full rounded-md shadow-sm sm:text-sm p-2 transition-colors duration-200
           {{ $errors->has('website') ? 'border-red-500 focus:ring-red-500' : 'border-gray-300 focus:ring-indigo-500' }} focus:border-indigo-500"
                                placeholder="e.g., https://www.google.com">
                            @error('website')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Owner Details Section -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6 text-gray-900">
                        <h2 class="text-xl font-semibold mb-4">{{ __('Owner Details') }}</h2>

                        <!-- Owner Name Field -->
                        <div class="mb-4">
                            <label for="owner_name" class="block text-sm font-medium text-gray-700">Owner Name</label>
                            <input type="text" name="owner_name" id="owner_name" value="{{ old('owner_name') }}"
                                class="mt-1 block w-full rounded-md shadow-sm sm:text-sm p-2 transition-colors duration-200
                           {{ $errors->has('owner_name') ? 'border-red-500 focus:ring-red-500' : 'border-gray-300 focus:ring-indigo-500' }} focus:border-indigo-500"
                                placeholder="e.g., John Doe">
                            @error('owner_name')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <!-- Owner Email Field -->
                        <div class="mb-4">
                            <label for="owner_email" class="block text-sm font-medium text-gray-700">Owner Email</label>
                            <input type="email" name="owner_email" id="owner_email" value="{{ old('owner_email') }}"
                                class="mt-1 block w-full rounded-md shadow-sm sm:text-sm p-2 transition-colors duration-200
                           {{ $errors->has('owner_email') ? 'border-red-500 focus:ring-red-500' : 'border-gray-300 focus:ring-indigo-500' }} focus:border-indigo-500"
                                placeholder="e.g., john.doe@example.com">
                            @error('owner_email')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password Field -->
                        <x-password-input id="owner_password" name="owner_password" />
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex justify-end space-x-2">
                    <x-buttons.back-button href="{{ route('companies.index') }}">Cancel</x-buttons.back-button>
                    <x-buttons.submit-button>Save Company</x-buttons.submit-button>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>
