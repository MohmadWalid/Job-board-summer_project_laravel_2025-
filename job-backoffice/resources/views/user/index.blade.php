<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @if (request()->has('archived'))
                {{ __('Archived Users') }}
            @else
                {{ __('Users') }}
                <span
                    class="ml-3 inline-flex items-center px-3 py-1 rounded-full text-lg font-semibold bg-indigo-100 text-indigo-800">
                    {{ $users->total() }}
                </span>
            @endif
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <x-toast-message />

            <div class="flex justify-between items-center py-8">
                <!-- Active and Archived toggle -->
                <div class="flex items-center space-x-4">
                    <x-status-toggle route-name="users.index" active-label="Active Users"
                        archived-label="Archived Users" />

                    @if (!request()->has('archived'))
                        <!-- Role filter buttons (only for active users) -->
                        <div class="flex items-center space-x-2 ml-8">
                            <span class="text-sm font-medium text-gray-700">Filter by Role:</span>

                            {{-- All Users --}}
                            <a href="{{ route('users.index', array_filter(request()->except(['role', 'page']))) }}"
                                class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200
                                {{ !request('role') ? 'bg-indigo-100 text-indigo-700 border-2 border-indigo-300' : 'bg-white text-gray-700 border border-gray-300 hover:bg-gray-50' }}">
                                All
                            </a>

                            {{-- Job Seekers --}}
                            <a href="{{ route('users.index', array_merge(request()->except('page'), ['role' => 'job-seeker'])) }}"
                                class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200
                                {{ request('role') == 'job-seeker' ? 'bg-green-100 text-green-700 border-2 border-green-300' : 'bg-white text-gray-700 border border-gray-300 hover:bg-gray-50' }}">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z" />
                                </svg>
                                Job Seekers
                            </a>

                            {{-- Company Owners --}}
                            <a href="{{ route('users.index', array_merge(request()->except('page'), ['role' => 'company-owner'])) }}"
                                class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium transition-colors duration-200
                                {{ request('role') == 'company-owner' ? 'bg-purple-100 text-purple-700 border-2 border-purple-300' : 'bg-white text-gray-700 border border-gray-300 hover:bg-gray-50' }}">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 7V3H2v18h20V7H12zM6 19H4v-2h2v2zm0-4H4v-2h2v2zm0-4H4V9h2v2zm0-4H4V5h2v2zm4 12H8v-2h2v2zm0-4H8v-2h2v2zm0-4H8V9h2v2zm0-4H8V5h2v2zm10 12h-8v-2h2v-2h-2v-2h2v-2h-2V9h8v10zm-2-8h-2v2h2v-2zm0 4h-2v2h2v-2z" />
                                </svg>
                                Company Owners
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    {{-- Name column --}}
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Name
                                    </th>

                                    {{-- Email column --}}
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Email
                                    </th>

                                    {{-- Role column --}}
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Role
                                    </th>

                                    {{-- Edit column (only for active users) --}}
                                    @if (!request()->has('archived'))
                                        <th scope="col"
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Edit
                                        </th>
                                    @endif

                                    {{-- Archive/Restore column --}}
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        @if (request()->has('archived'))
                                            Restore
                                        @else
                                            Archive
                                        @endif
                                    </th>
                                </tr>
                            </thead>

                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($users as $user)
                                    <tr class="hover:bg-gray-50">
                                        {{-- Name --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $user->name }}
                                        </td>

                                        {{-- Email --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                            {{ $user->email }}
                                        </td>

                                        {{-- Role Badge --}}
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
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
                                        </td>

                                        {{-- (Only visible for active, non-admin users) --}}
                                        @if ($user->role != 'admin')
                                            {{-- Edit Button (only for active users) --}}
                                            @if (!request()->has('archived'))
                                                <x-icons.edit-icon href="{{ route('users.edit', $user->id) }}" />
                                            @endif

                                            {{-- Archive/Restore Button --}}
                                            <td class="px-10 py-4 whitespace-nowrap text-sm text-gray-500">
                                                @if (request()->has('archived'))
                                                    <x-icons.restore-icon
                                                        action="{{ route('users.restore', $user->id) }}" />
                                                @else
                                                    <x-icons.archive-icon
                                                        action="{{ route('users.destroy', $user->id) }}" />
                                                @endif
                                            </td>
                                        @else
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-400">
                                                <span class="font-medium">System Role</span>
                                            </td>
                                        @endif
                                    </tr>
                                    @empty
                                        <tr>
                                            <td colspan="{{ request()->has('archived') ? '5' : '6' }}"
                                                class="py-24 text-center align-middle">

                                                <div class="max-w-md mx-auto">
                                                    <!-- Icon -->
                                                    <div
                                                        class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-indigo-50">
                                                        <svg class="mx-auto h-16 w-16 text-gray-300" fill="none"
                                                            stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="1.5"
                                                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                                        </svg>
                                                    </div>

                                                    <!-- Title – Context Aware -->
                                                    <h3 class="mt-6 text-xl font-semibold text-gray-900">
                                                        @if (request()->has('archived'))
                                                            No archived users
                                                        @elseif (request('role') == 'job-seeker')
                                                            No job seekers found
                                                        @elseif (request('role') == 'company-owner')
                                                            No company owners found
                                                        @endif
                                                    </h3>

                                                    <!-- Subtitle – Helpful & Friendly -->
                                                    <p class="mt-3 text-sm text-gray-500 leading-relaxed max-w-xs mx-auto">
                                                        @if (request()->has('archived'))
                                                            Archived users are hidden from the system but can be restored
                                                            anytime.
                                                        @elseif (request('role'))
                                                            Try adjusting your filters to see more users.
                                                        @endif
                                                    </p>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                {{-- Pagination --}}
                <div class="mt-4">
                    {{ $users->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </x-app-layout>
