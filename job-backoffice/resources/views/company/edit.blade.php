<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Edit Company - ' . $company->name) }}
            </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <form
                action="{{ auth()->user()->role == 'admin' ? route('companies.update', $company) : route('my-company.update') }}"
                method="POST">
                @csrf
                @method('PUT')

                {{-- Add this hidden input to preserve the redirect parameter --}}
                <input type="hidden" name="redirect" value="{{ request()->query('redirect', 'index') }}">

                <!-- Company Details Section -->
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-xl mb-6 border border-gray-100">
                    <div class="p-8 text-gray-900">
                        <h2 class="text-2xl font-bold mb-6 text-black-700">{{ __('Company Information') }}</h2>

                        <!-- Company Name Field -->
                        <div class="mb-5">
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">Company
                                Name</label>
                            <input type="text" name="name" id="name" {{-- Pre-fill with existing name, falling back to old() --}}
                                value="{{ old('name', $company->name) }}"
                                class="mt-1 block w-full rounded-lg border-2
                            {{ $errors->has('name') ? 'border-red-500 focus:ring-red-500' : 'border-gray-200 focus:ring-indigo-600' }}
                            focus:border-indigo-600 p-3 shadow-sm transition-all duration-200 text-gray-800"
                                placeholder="e.g., Google">

                            @error('name')
                                <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Industry Field -->
                        <div class="mb-4">
                            <label for="industry" class="block text-sm font-medium text-gray-700">
                                Industry
                            </label>

                            <div class="relative mt-1">
                                <select name="industry" id="industry"
                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm px-3 py-2 pr-10 bg-white cursor-pointer hover:border-indigo-400 transition-colors
                            @error('industry') border-red-500 ring-red-500 @enderror">
                                    <option value="" disabled>Select an Industry</option>
                                    @foreach ($industries as $industry)
                                        <option value="{{ $industry }}"
                                            {{ old('industry', $company->industry) === $industry ? 'selected' : '' }}>
                                            {{ ucfirst($industry) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            @error('industry')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Address Field -->
                        <div class="mb-5">
                            <label for="address" class="block text-sm font-semibold text-gray-700 mb-1">Address</label>
                            <input type="text" name="address" id="address" {{-- Pre-fill with existing address, falling back to old() --}}
                                value="{{ old('address', $company->address) }}"
                                class="mt-1 block w-full rounded-lg border-2
                            {{ $errors->has('address') ? 'border-red-500 focus:ring-red-500' : 'border-gray-200 focus:ring-indigo-600' }}
                            focus:border-indigo-600 p-3 shadow-sm transition-all duration-200 text-gray-800"
                                placeholder="e.g., 123 Main St, Anytown USA">

                            @error('address')
                                <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Website Field -->
                        <div class="mb-0">
                            <label for="website" class="block text-sm font-semibold text-gray-700 mb-1">Website
                                (Optional)</label>
                            <input type="url" name="website" id="website" {{-- Pre-fill with existing website, falling back to old() --}}
                                value="{{ old('website', $company->website) }}"
                                class="mt-1 block w-full rounded-lg border-2
                            {{ $errors->has('website') ? 'border-red-500 focus:ring-red-500' : 'border-gray-200 focus:ring-indigo-600' }}
                            focus:border-indigo-600 p-3 shadow-sm transition-all duration-200 text-gray-800"
                                placeholder="e.g., https://www.example.com">

                            @error('website')
                                <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                    </div>
                </div>

                <!-- ---------------------------------------------------------------------- -->
                <!-- OWNER DETAILS SECTION -->
                <!-- ---------------------------------------------------------------------- -->
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-xl mb-6 border border-gray-100">
                    <div class="p-8 text-gray-900">
                        <!-- Note: Changed title color to indigo-700 for a modern look, assuming it's what you want for headers. -->
                        <h2 class="text-2xl font-bold mb-6 text-black-700">{{ __('Owner Details') }}</h2>

                        <!-- Owner Name Field -->
                        <div class="mb-5">
                            <label for="owner_name" class="block text-sm font-semibold text-gray-700 mb-1">Owner
                                Name</label>
                            <input type="text" name="owner_name" id="owner_name"
                                value="{{ old('owner_name', $company->owner->name) }}" {{-- Assumes $company->owner_name exists --}}
                                class="mt-1 block w-full rounded-lg border-2
                                {{ $errors->has('owner_name') ? 'border-red-500 focus:ring-red-500' : 'border-gray-200 focus:ring-indigo-600' }}
                                focus:border-indigo-600 p-3 shadow-sm transition-all duration-200 text-gray-800"
                                placeholder="e.g., Jane Doe">

                            @error('owner_name')
                                <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Owner Email Field (Disabled - Read-only reference) -->
                        <div class="mb-5">
                            <label for="owner_email" class="block text-sm font-semibold text-gray-700 mb-1">Owner
                                Email</label>
                            <input type="email" id="owner_email" disabled value="{{ $company->owner->email }}"
                                class="mt-1 block w-full rounded-lg border-2 border-gray-200 p-3 shadow-sm text-gray-600 bg-gray-100 cursor-not-allowed">
                        </div>


                        <!-- Owner Password Field (Optional, for updating) -->
                        <x-password-input id="owner_password" name="owner_password" :required="false"
                            label="Change Owner
                            Password (Leave it blank to keep the same)" />

                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex justify-end space-x-3 mt-8">
                    <x-buttons.back-button
                        href="{{ auth()->user()->role === 'admin'
                            ? (request()->query('redirect') === 'show'
                                ? route('companies.show', $company)
                                : route('companies.index'))
                            : route('my-company.show') }}">
                        Cancel
                    </x-buttons.back-button>

                    {{-- Update Button --}}
                    <x-buttons.submit-button>Update Company</x-submit-button>
                </div>
            </form>
        </div>
    </div>

</x-app-layout>
