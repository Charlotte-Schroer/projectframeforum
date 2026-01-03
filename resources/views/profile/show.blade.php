<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __($user->username . ' | Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Profile Header -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm overflow-hidden mb-6">
                <div class="p-8">
                    <div class="flex flex-col md:flex-row items-center md:items-start gap-6">
                        <!-- Profile Photo -->
                        <div class="flex-shrink-0">
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
                        </div>

                        <!-- Profile Info -->
                        <div class="flex-grow text-center md:text-left">
                            <div class="flex flex-col md:flex-row md:items-center gap-3 mb-4">
                                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">
                                    {{ $user->username }}
                                </h1>
                                @if($user->is_admin)
                                    <span
                                        class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800 dark:bg-red-900 dark:text-red-200">
                                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                                            </path>
                                        </svg>
                                        Admin
                                    </span>
                                @endif
                            </div>

                            <div class="space-y-2 text-gray-600 dark:text-gray-400">
                                @if($user->birthday)
                                    <div class="flex items-center justify-center md:justify-start">
                                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                            </path>
                                        </svg>
                                        <span>{{ $user->birthday->format('d F Y') }} ({{ $user->birthday->age }}
                                            years old)</span>
                                    </div>
                                @endif

                                <div class="flex items-center justify-center md:justify-start">
                                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <span>Member since {{ $user->created_at->format('F Y') }}</span>
                                </div>
                            </div>

                            @if($user->about_me)
                                <div class="mt-4 p-4 bg-gray-50 dark:bg-gray-900 rounded-lg">
                                    <p class="text-gray-700 dark:text-gray-300">{{ $user->about_me }}</p>
                                </div>
                            @endif

                            <!-- Edit Button (only for own profile) -->
                            @auth
                                @if(Auth::id() === $user->id)
                                    <div class="mt-4">
                                        <a href="{{ route('profile.edit') }}"
                                            class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                </path>
                                            </svg>
                                            Edit Profile
                                        </a>
                                    </div>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            </div>

            <!-- User's Content -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- News Articles (if admin) -->
                @if($user->is_admin && $news->isNotEmpty())
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z">
                                </path>
                            </svg>
                            Published News
                        </h2>
                        <div class="space-y-3">
                            @foreach($news as $item)
                                <a href="{{ route('news.show', $item) }}"
                                    class="block p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                    <h3 class="font-semibold text-gray-900 dark:text-white">{{ $item->title }}</h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ $item->publication_date->format('d M Y') }}
                                    </p>
                                </a>
                            @endforeach
                        </div>
                        @if($user->news()->count() > 6)
                            <a href="{{ route('news.index') }}"
                                class="block mt-4 text-center text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300 text-sm font-medium">
                                View all news items →
                            </a>
                        @endif
                    </div>
                @endif

                <!-- Forum Topics -->
                @if($topics->isNotEmpty())
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z">
                                </path>
                            </svg>
                            Forum Topics
                        </h2>
                        <div class="space-y-3">
                            @foreach($topics as $topic)
                                <a href="{{ route('forum.show', $topic) }}"
                                    class="block p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                    <h3 class="font-semibold text-gray-900 dark:text-white">{{ $topic->title }}</h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ $topic->created_at->diffForHumans() }}
                                    </p>
                                </a>
                            @endforeach
                        </div>
                        @if($user->topics()->count() > 5)
                            <a href="{{ route('forum.index') }}"
                                class="block mt-4 text-center text-indigo-600 dark:text-indigo-400 hover:text-indigo-700 dark:hover:text-indigo-300 text-sm font-medium">
                                View all topics →
                            </a>
                        @endif
                    </div>
                @endif

                <!-- Forum Replies -->
                @if($posts->isNotEmpty())
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6">
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-4 flex items-center">
                            <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z">
                                </path>
                            </svg>
                            Recent Replies
                        </h2>
                        <div class="space-y-3">
                            @foreach($posts as $post)
                                <a href="{{ route('forum.show', $post->topic) }}#post-{{ $post->id }}"
                                    class="block p-3 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                    <p class="text-sm text-gray-900 dark:text-white line-clamp-2 mb-1 italic">
                                        "{{ $post->content }}"
                                    </p>
                                    <p class="text-xs text-indigo-600 dark:text-indigo-400 font-medium">
                                        in: {{ $post->topic->title }}
                                    </p>
                                    <p class="text-[10px] text-gray-500 dark:text-gray-400 mt-1">
                                        {{ $post->created_at->diffForHumans() }}
                                    </p>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Empty State -->
                @if($news->isEmpty() && $topics->isEmpty() && $posts->isEmpty())
                    <div class="lg:col-span-2 bg-white dark:bg-gray-800 rounded-lg shadow-sm p-12 text-center">
                        <div class="text-6xl mb-4">👤</div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                            No activity yet
                        </h3>
                        <p class="text-gray-600 dark:text-gray-400">
                            {{ $user->username }} hasn't published anything yet.
                        </p>
                    </div>
                @endif
            </div>
        </div>
    </div>


</x-app-layout>