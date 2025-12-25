<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Profiles') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8 flex items-center justify-between gap-6">
                <div>
                <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-2">
                    Members
                </h1>
                <p class="text-gray-600 dark:text-gray-400">
                    Who are our members? Find here public profiles.
                </p>
                </div>
                <form action="{{ route('profile.index') }}" method="get"
                    class="flex items-center gap-4">
                    <input
                        type="text"
                        name="search"
                        placeholder="Search Member"
                        value="{{ request('search') }}"
                        class="border border-gray-300 text-gray-600 placeholder-gray-400
                         rounded px-3 py-2
                         focus:border-gray-400 focus:ring-gray-400"
                    />
                    <x-primary-button type="submit">
                        Search</x-primary-button>
                </form>
            </div>


            @if($users->isEmpty())
                <!-- Empty State -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-12 text-center">
                    <div class="text-6xl mb-4">👤</div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                        No members yet!
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400">
                        There are no members yet, try again later.
                    </p>
                </div>
            @else
                <!-- Profiles Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                    @foreach($users as $user)
                        <article
                            class="bg-white dark:bg-gray-800 rounded-lg shadow-sm overflow-hidden hover:shadow-md dark:hover:bg-gray-700 transition-shadow duration-200">
                            <!-- Image -->
                            <a href="{{ route('profile.show', $user->username) }}"
                                class="flex flex-col items-center p-6 transition-colors duration-200">
                                @if($user->profile_photo)
                                    <img src="{{ asset('storage/' . $user->profile_photo) }}" alt="{{ $user->username }}"
                                        class="w-32 h-32 rounded-full object-cover border-4 border-indigo-100 dark:border-indigo-900">
                                @else
                                    <div
                                        class="w-32 h-32 rounded-full bg-indigo-100 dark:bg-indigo-900 flex items-center justify-center border-4 border-indigo-200 dark:border-indigo-800">
                                        <span class="text-4xl font-bold text-indigo-600 dark:text-indigo-400">
                                            {{ strtoupper(substr($user->username, 0, 1)) }}
                                        </span>
                                    </div>
                                @endif
                                <h3 class="mt-4 text-xl font-bold text-gray-900 dark:text-white">{{ $user->username }}</h3>
                            </a>
                        </article>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
