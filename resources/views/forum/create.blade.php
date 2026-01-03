<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Start a New Topic') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('forum.store') }}" method="POST">
                        @csrf

                        <div class="mb-4">
                            <x-input-label for="title" :value="__('Title')" />
                            <x-text-input id="title" name="title" type="text" class="mt-1 block w-full"
                                :value="old('title')" required autofocus placeholder="What is it about?" />
                            <x-input-error class="mt-2" :messages="$errors->get('title')" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="movie_title" :value="__('Movie Title (Optional)')" />
                            <x-text-input id="movie_title" name="movie_title" type="text" class="mt-1 block w-full"
                                :value="old('movie_title')" placeholder="Which movie is this about?" />
                            <x-input-error class="mt-2" :messages="$errors->get('movie_title')" />
                        </div>

                        <div class="mb-4">
                            <x-input-label for="content" :value="__('Content')" />
                            <textarea id="content" name="content" rows="10"
                                class="mt-1 block w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                required
                                placeholder="Tell your story or ask your question...">{{ old('content') }}</textarea>
                            <x-input-error class="mt-2" :messages="$errors->get('content')" />
                        </div>

                        <div class="mb-6">
                            <x-input-label :value="__('Tags')" />
                            <div class="mt-2 grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-2">
                                @foreach($tags as $tag)
                                    <label
                                        class="inline-flex items-center px-3 py-2 border border-gray-300 dark:border-gray-700 rounded-md cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700 transition has-[:checked]:bg-indigo-50 dark:has-[:checked]:bg-indigo-900/30 has-[:checked]:border-indigo-500">
                                        <input type="checkbox" name="tags[]" value="{{ $tag->id }}" class="hidden" {{ is_array(old('tags')) && in_array($tag->id, old('tags')) ? 'checked' : '' }}>
                                        <span class="text-sm text-gray-700 dark:text-gray-300">{{ $tag->name }}</span>
                                    </label>
                                @endforeach
                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('tags')" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>{{ __('Post Topic') }}</x-primary-button>
                            <a href="{{ route('forum.index') }}"
                                class="text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 underline decoration-2 underline-offset-4">
                                {{ __('Cancel') }}
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>