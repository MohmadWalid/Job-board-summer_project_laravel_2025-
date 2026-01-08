<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <x-buttons.back-button href="{{ route('users.index') }}">
                Back
            </x-buttons.back-button>

            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit User Password & Name
            </h2>

            <div class="w-24"></div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <form action="{{ route('users.update', $user->id) }}" method="POST" class="p-6">
                    @csrf
                    @method('PUT')

                    <h3 class="text-xl font-bold mb-6 text-gray-900">User Informations</h3>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-6">

                        {{-- LEFT COLUMN: Editable Fields (Name and Password) --}}
                        <div class="sm:col-span-1 space-y-6">
                            <div class="mb-5">
                                <label for="name" class="block text-sm font-semibold text-gray-700 mb-1">Change User
                                    Name</label>
                                <input type="text" name="name" id="name"
                                    value="{{ old('name', $user->name) }}"
                                    class="mt-1 block w-full rounded-lg border-2
                                {{ $errors->has('name') ? 'border-red-500 focus:ring-red-500' : 'border-gray-200 focus:ring-indigo-600' }}
                                focus:border-indigo-600 p-3 shadow-sm transition-all duration-200 text-gray-800"
                                    placeholder="e.g., Jane Doe">

                                @error('name')
                                    <p class="mt-2 text-sm text-red-600 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <x-password-input id="password" name="password" :required="false"
                                    label="Change Password (Leave it blank to keep the same)" />
                            </div>
                        </div>

                        {{-- Moved Email and Role into this container --}}
                        <div class="sm:col-span-1 border-l border-gray-200 pl-6 space-y-6">

                            <div>
                                <dt class="text-sm font-medium text-gray-500 mb-1">Email</dt>
                                <dd class="text-sm text-gray-900 font-medium">{{ $user->email }}</dd>
                            </div>

                            <div>
                                <dt class="text-sm font-medium text-gray-500 mb-1">Role</dt>
                                <dd class="text-sm text-gray-900 font-medium">
                                    @switch($user->role)
                                        @case('admin')
                                            <span
                                                class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-red-100 text-red-800">
                                                Admin
                                            </span>
                                        @break

                                        @case('company-owner')
                                            <span
                                                class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-100 text-purple-800">
                                                Company Owner
                                            </span>
                                        @break

                                        @case('job-seeker')
                                            <span
                                                class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Job Seeker
                                            </span>
                                        @break

                                        @default
                                            <span
                                                class="px-3 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                                {{ ucfirst($user->role) }}
                                            </span>
                                    @endswitch
                                </dd>
                            </div>
                        </div>

                    </div>

                    <div class="mt-8 pt-4 border-t border-gray-200 flex items-center justify-end space-x-4">
                        <x-buttons.back-button href="{{ route('users.index') }}">
                            Back
                        </x-buttons.back-button>

                        {{-- Update Button --}}
                        <x-buttons.submit-button>Update the Password</x-buttons.submit-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
