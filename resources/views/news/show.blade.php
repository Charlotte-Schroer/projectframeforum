@extends('layouts.app')

@section('title', $news->title)

@section('content')
    <div class="py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Back Button -->
            <div class="mb-6">
                <a href="{{ route('news.index') }}"
                   class="inline-flex items-center text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Back to overview
                </a>
            </div>

            <!-- Article -->
            <article class="bg-white dark:bg-gray-800 rounded-lg shadow-sm overflow-hidden">
                <!-- Featured Image -->
                <div class="aspect-video overflow-hidden bg-gray-200 dark:bg-gray-700">
                    <img src="{{ asset('storage/' . $news->image) }}"
                         alt="{{ $news->title }}"
                         class="w-full h-full object-cover">
                </div>

                <!-- Content -->
                <div class="p-8">
                    <!-- Meta Info -->
                    <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500 dark:text-gray-400 mb-6 pb-6 border-b border-gray-200 dark:border-gray-700">
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                            <time datetime="{{ $news->publication_date->format('Y-m-d') }}">
                                {{ $news->publication_date->format('d F Y') }}
                            </time>
                        </div>
                        <div class="flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                            </svg>
                            <a href="{{ route('profile.show', $news->user->username) }}"
                               class="hover:text-indigo-600 dark:hover:text-indigo-400">
                                {{ $news->user->username }}
                            </a>
                        </div>
                    </div>

                    <!-- Title -->
                    <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-6">
                        {{ $news->title }}
                    </h1>

                    <!-- Article Content -->
                    <div class="prose prose-lg dark:prose-invert max-w-none">
                        <div class="text-gray-700 dark:text-gray-300 leading-relaxed whitespace-pre-line">
                            {{ $news->content }}
                        </div>
                    </div>

                    <!-- Admin Actions -->
                    @auth
                        @if(Auth::user()->is_admin)
                            <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                                <div class="flex gap-3">
                                    <a href="{{ route('admin.news.edit', $news) }}"
                                       class="inline-flex items-center px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700 transition">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                        Edit
                                    </a>
                                    <form action="{{ route('admin.news.destroy', $news) }}"
                                          method="POST"
                                          onsubmit="return confirm('Weet je zeker dat je dit nieuwtje wilt verwijderen?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="inline-flex items-center px-4 py-2 bg-red-600 text-white rounded-md hover:bg-red-700 transition">
                                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                            Delete
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    @endauth
                </div>
            </article>

            <!-- Related News -->
            @if($relatedNews->isNotEmpty())
                <div class="mt-12">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-white mb-6">
                        More news
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        @foreach($relatedNews as $item)
                            <article class="bg-white dark:bg-gray-800 rounded-lg shadow-sm overflow-hidden hover:shadow-md transition-shadow">
                                <a href="{{ route('news.show', $item) }}" class="block aspect-video overflow-hidden bg-gray-200 dark:bg-gray-700">
                                    <img src="{{ asset('storage/' . $item->image) }}"
                                         alt="{{ $item->title }}"
                                         class="w-full h-full object-cover hover:scale-105 transition-transform duration-200">
                                </a>
                                <div class="p-4">
                                    <time class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ $item->publication_date->format('d M Y') }}
                                    </time>
                                    <h3 class="font-semibold text-gray-900 dark:text-white mt-2 line-clamp-2">
                                        <a href="{{ route('news.show', $item) }}" class="hover:text-indigo-600 dark:hover:text-indigo-400">
                                            {{ $item->title }}
                                        </a>
                                    </h3>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
