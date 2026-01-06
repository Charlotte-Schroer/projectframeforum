<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center gap-4">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight truncate">
                {{ $topic->title }}
            </h2>
            <div class="flex shrink-0 gap-2">
                @if(Auth::check() && (Auth::id() === $topic->user_id || Auth::user()->is_admin))
                    <a href="{{ route('forum.edit', $topic) }}"
                        class="inline-flex items-center px-4 py-2 bg-white dark:bg-gray-800 border border-gray-300 dark:border-gray-500 rounded-md font-semibold text-xs text-gray-700 dark:text-gray-300 uppercase tracking-widest shadow-sm hover:bg-gray-50 dark:hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 disabled:opacity-25 transition ease-in-out duration-150">
                        {{ __('Edit') }}
                    </a>
                @endif
                @if(Auth::user()->is_admin)
                    <form action="{{ route('admin.forum.destroy', $topic) }}" method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this topic?');">
                        @csrf
                        @method('DELETE')
                        <x-danger-button type="submit">{{ __('Delete') }}</x-danger-button>
                    </form>
                @endif
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Topic Card -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center gap-3">
                            @if($topic->user->profile_photo)
                                <img src="{{ asset('storage/' . $topic->user->profile_photo) }}"
                                    class="w-10 h-10 rounded-full object-cover">
                            @else
                                <div
                                    class="w-10 h-10 rounded-full bg-indigo-100 dark:bg-indigo-900 flex items-center justify-center font-bold text-indigo-600 dark:text-indigo-400">
                                    {{ strtoupper(substr($topic->user->username, 0, 1)) }}
                                </div>
                            @endif
                            <div>
                                <a href="{{ route('profile.show', $topic->user->username) }}"
                                    class="font-bold hover:underline">{{ $topic->user->username }}</a>
                                <div class="text-xs text-gray-500 dark:text-gray-400">
                                    {{ $topic->created_at->format('d M Y H:i') }}</div>
                            </div>
                        </div>
                        <div class="flex gap-2">
                            @foreach($topic->tags as $tag)
                                <span
                                    class="px-2 py-0.5 rounded-full bg-indigo-100 dark:bg-indigo-900 text-xs font-medium text-indigo-800 dark:text-indigo-200">
                                    {{ $tag->name }}
                                </span>
                            @endforeach
                        </div>
                    </div>

                    @if($topic->movie_title)
                        <div
                            class="mb-4 inline-flex items-center gap-2 px-3 py-1 rounded-md bg-gray-100 dark:bg-gray-700 text-sm">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M7 4v16M17 4v16M3 8h4m10 0h4M3 12h18M3 16h4m10 0h4M4 20h16a1 1 0 001-1V5a1 1 0 00-1-1H4a1 1 0 00-1 1v14a1 1 0 001 1z" />
                            </svg>
                            <span class="font-medium text-gray-600 dark:text-gray-300">Movie:
                                {{ $topic->movie_title }}</span>
                        </div>
                    @endif

                    <div class="prose dark:prose-invert max-w-none">
                        {!! nl2br(e($topic->content)) !!}
                    </div>
                </div>
            </div>

            <!-- Replies -->
            <h3 class="text-lg font-bold text-gray-800 dark:text-gray-200 mb-4 px-4 sm:px-0">
                Replies ({{ $topic->posts->count() }})
            </h3>

            @foreach($topic->posts as $post)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-4"
                    id="post-{{ $post->id }}">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex items-center gap-3">
                                @if($post->user->profile_photo)
                                    <img src="{{ asset('storage/' . $post->user->profile_photo) }}"
                                        class="w-8 h-8 rounded-full object-cover">
                                @else
                                    <div
                                        class="w-8 h-8 rounded-full bg-gray-100 dark:bg-gray-700 flex items-center justify-center font-bold text-gray-600 dark:text-gray-400 text-sm">
                                        {{ strtoupper(substr($post->user->username, 0, 1)) }}
                                    </div>
                                @endif
                                <div>
                                    <a href="{{ route('profile.show', $post->user->username) }}"
                                        class="font-bold text-sm hover:underline">{{ $post->user->username }}</a>
                                    <div class="text-[10px] text-gray-500 dark:text-gray-400">
                                        {{ $post->created_at->diffForHumans() }}</div>
                                </div>
                            </div>

                            <div class="flex gap-2">
                                @if(Auth::id() === $post->user_id || Auth::user()->is_admin)
                                    <a href="{{ route('posts.edit', $post) }}"
                                        class="text-xs text-indigo-600 dark:text-indigo-400 hover:underline">Edit</a>
                                @endif
                                @if(Auth::user()->is_admin)
                                    <form action="{{ route('posts.destroy', $post) }}" method="POST"
                                        onsubmit="return confirm('Are you sure you want to delete this reply?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="text-xs text-red-600 dark:text-red-400 hover:underline">Delete</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                        <div class="text-sm">
                            {!! nl2br(e($post->content)) !!}
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Reply Form -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mt-8">
                <div class="p-6">
                    <h4 class="font-bold text-gray-800 dark:text-gray-200 mb-4">Post a reply</h4>
                    <form action="{{ route('posts.store', $topic) }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <textarea name="content" rows="4"
                                class="block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                placeholder="What are your thoughts?" required minlength="3"></textarea>
                            @error('content')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <x-primary-button>
                            {{ __('Send Reply') }}
                        </x-primary-button>
                    </form>
                </div>
            </div>

            <div class="mt-6">
                <a href="{{ route('forum.index') }}"
                    class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 flex items-center gap-1 group">
                    <svg class="w-4 h-4 group-hover:-translate-x-1 transition-transform" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back to Forum
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
