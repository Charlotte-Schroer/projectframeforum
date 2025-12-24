<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('FrameNews') }}
        </h2>
    </x-slot>
    <div class="py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-2">
                    🎬 FrameNews
                </h1>
                <p class="text-gray-600 dark:text-gray-400">
                    Stay tuned of the latest news!
                </p>
            </div>

            @if($news->isEmpty())
                <!-- Empty State -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-12 text-center">
                    <div class="text-6xl mb-4">📰</div>
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                        No news items yet!
                    </h3>
                    <p class="text-gray-600 dark:text-gray-400">
                        There a no items published yet, try again.
                    </p>
                </div>
            @else
                <!-- News Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                    @foreach($news as $item)
                        <article
                            class="bg-white dark:bg-gray-800 rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow duration-200">
                            <!-- Image -->
                            <a href="{{ route('news.show', $item) }}"
                                class="block aspect-video overflow-hidden bg-gray-200 dark:bg-gray-700">
                                <img src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->title }}"
                                    class="w-full h-full object-cover hover:scale-105 transition-transform duration-200">
                            </a>

                            <!-- Content -->
                            <div class="p-6">
                                <!-- Date & Author -->
                                <div class="flex items-center text-sm text-gray-500 dark:text-gray-400 mb-3">
                                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                                        </path>
                                    </svg>
                                    <time datetime="{{ $item->publication_date->format('Y-m-d') }}">
                                        {{ $item->publication_date->format('d M Y') }}
                                    </time>
                                    <span class="mx-2">•</span>
                                    <span>{{ $item->user->username }}</span>
                                </div>

                                <!-- Title -->
                                <h2 class="text-xl font-bold text-gray-900 dark:text-white mb-2 line-clamp-2">
                                    <a href="{{ route('news.show', $item) }}"
                                        class="hover:text-emerald-600 dark:hover:text-emerald-400 transition-colors">
                                        {{ $item->title }}
                                    </a>
                                </h2>

                                <!-- Excerpt -->
                                <p class="text-gray-600 dark:text-gray-400 mb-4 line-clamp-3">
                                    {{ Str::limit(strip_tags($item->content), 120) }}
                                </p>

                                <!-- Read More -->
                                <a href="{{ route('news.show', $item) }}"
                                    class="inline-flex items-center text-emerald-600 dark:text-emerald-400 hover:text-emerald-700 dark:hover:text-emerald-300 font-medium">
                                    Read more
                                    <svg class="w-4 h-4 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                        </path>
                                    </svg>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $news->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
