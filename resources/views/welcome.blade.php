<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Welcome') }}
        </h2>
    </x-slot>
    <!-- Hero Section -->
    <div class="bg-gradient-to-br from-emerald-50 to-teal-50 dark:from-gray-900 dark:to-emerald-900 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <!-- Application Logo -->
                <div class="flex justify-center mb-6">
                    <x-application-logo class="w-20 h-20 fill-current text-emerald-600 dark:text-emerald-400" />
                </div>

                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4">
                    Welcome to FrameForum! 🎬
                </h1>

                <p class="text-lg text-gray-600 dark:text-gray-300 mb-6 max-w-2xl mx-auto">
                    The ultimate destination for everything movie-related. Join our community to discuss, share, and
                    discover the latest in cinema.
                </p>

                <div class="flex flex-col sm:flex-row justify-center gap-3">
                    <a href="{{ route('news.index') }}"
                        class="bg-emerald-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-emerald-700 transition-colors duration-200 shadow-lg hover:shadow-xl">
                        Explore News
                    </a>
                    <a href="{{ route('forum.index') }}"
                        class="bg-white dark:bg-gray-800 text-emerald-600 dark:text-emerald-400 border-2 border-emerald-600 dark:border-emerald-400 px-6 py-3 rounded-lg font-semibold hover:bg-emerald-50 dark:hover:bg-gray-700 transition-colors duration-200">
                        Visit Forum
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
