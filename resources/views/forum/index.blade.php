<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Forum') }}
            </h2>
            <a href="{{ route('forum.create') }}"
                class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                {{ __('New Topic') }}
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Search and Filter -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('forum.index') }}" method="GET"
                        class="space-y-4 md:space-y-0 md:flex md:items-center md:gap-4">
                        <div class="flex-1">
                            <x-text-input id="search" name="search" type="text" class="block w-full"
                                :value="request('search')" placeholder="Search topics..." />
                        </div>
                        <div class="w-full md:w-48">
                            <select name="tag"
                                class="block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm">
                                <option value="">All Tags</option>
                                @foreach($tags as $tag)
                                    <option value="{{ $tag->name }}" {{ request('tag') == $tag->name ? 'selected' : '' }}>
                                        {{ $tag->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <x-secondary-button type="submit">
                            {{ __('Filter') }}
                        </x-secondary-button>

                        <a href="{{ route('forum.create') }}"
                            class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 ml-2">
                            {{ __('New Topic') }}
                        </a>

                        @if(request('search') || request('tag'))
                            <a href="{{ route('forum.index') }}"
                                class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 underline decoration-2 underline-offset-4 ml-4">
                                {{ __('Clear filters') }}
                            </a>
                        @endif
                    </form>
                </div>
            </div>

            <!-- Topics List -->
            @if($topics->count() > 0)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900 dark:text-gray-100 p-0">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-gray-50 dark:bg-gray-700">
                                        <th class="p-4 font-semibold text-sm uppercase text-gray-600 dark:text-gray-300">
                                            Topic</th>
                                        <th
                                            class="p-4 font-semibold text-sm uppercase text-gray-600 dark:text-gray-300 text-center">
                                            Replies</th>
                                        <th class="p-4 font-semibold text-sm uppercase text-gray-600 dark:text-gray-300">
                                            Last Activity</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                                    @foreach($topics as $topic)
                                        <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition">
                                            <td class="p-4">
                                                <div class="flex flex-col">
                                                    <a href="{{ route('forum.show', $topic) }}"
                                                        class="text-lg font-bold text-indigo-600 dark:text-indigo-400 hover:underline">
                                                        {{ $topic->title }}
                                                    </a>
                                                    @if($topic->movie_title)
                                                        <span class="text-xs text-gray-500 dark:text-gray-400 italic">Movie:
                                                            {{ $topic->movie_title }}</span>
                                                    @endif
                                                    <div class="flex items-center gap-2 mt-1">
                                                        <span class="text-xs text-gray-500 dark:text-gray-400">By
                                                            <a href="{{ route('profile.show', $topic->user->username) }}"
                                                                class="hover:underline font-medium text-gray-700 dark:text-gray-300">
                                                                {{ $topic->user->username }}
                                                            </a>
                                                        </span>
                                                        <div class="flex gap-1">
                                                            @foreach($topic->tags as $tag)
                                                                <span
                                                                    class="px-2 py-0.5 rounded-full bg-indigo-100 dark:bg-indigo-900 text-[10px] font-medium text-indigo-800 dark:text-indigo-200">
                                                                    {{ $tag->name }}
                                                                </span>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                            </td>
                                            <td class="p-4 text-center">
                                                <span
                                                    class="bg-gray-100 dark:bg-gray-600 px-3 py-1 rounded-full text-sm font-semibold">
                                                    {{ $topic->posts_count }}
                                                </span>
                                            </td>
                                            <td class="p-4">
                                                <div class="text-sm text-gray-600 dark:text-gray-400">
                                                    {{ $topic->updated_at->diffForHumans() }}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="mt-4 flex justify-between items-center">
                    {{ $topics->links() }}
                    
                    <a href="{{ route('forum.create') }}" 
                       class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                        {{ __('New Topic') }}
                    </a>
                </div>
            @else
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-12 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M17 8h2a2 0 012 2v6a2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 0 002-2V6a2 0 002-2H5a2 0 00-2 2v6a2 0 002 2h2v4l.586-.586z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900 dark:text-gray-100">No topics found</h3>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">Be the first to start a discussion!</p>
                    <div class="mt-6">
                        <a href="{{ route('forum.create') }}"
                            class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('New Topic') }}
                        </a>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>