<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight"> {{ __('Edit Job Categories') }} </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="py-12">
                <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <h2 class="text-xl font-semibold mb-4">{{ __('Edit Category') }}</h2>
                            <form action="{{ route('job-categories.update', $category->id) }}" method="POST">
                                @csrf
                                @method('PATCH')

                                {{-- Input field for the new category name --}}
                                <div class="mb-4">
                                    <label for="name" class="block text-sm font-medium text-gray-700">Category
                                        Name</label>
                                    <input type="text" name="name" id="name"
                                        value="{{ old('name', $category->name) }}"
                                        class="mt-1 block w-full rounded-md shadow-sm sm:text-sm p-2 transition-colors duration-200
                                        {{ $errors->has('name') ? 'border-red-500 focus:ring-red-500' : 'border-gray-300 focus:ring-indigo-500' }} focus:border-indigo-500"
                                        placeholder="e.g., Software Engineering">

                                    {{-- Validation error message for the 'name' field --}}
                                    @error('name')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                                {{-- Buttons to submit or cancel the form --}}
                                <div class="flex justify-end space-x-2">
                                    <x-buttons.back-button
                                        href="{{ request()->query('redirect') == 'show'
                                            ? route('job-categories.show', $category->id)
                                            : route('job-categories.index') }}">
                                        Cancel
                                    </x-buttons.back-button>

                                    {{-- Update Button --}}
                                    <x-buttons.submit-button>Update Category</x-buttons.submit-button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
