<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Admin Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-bold mb-4">Welcome to the Admin Panel 🔐</h3>
                    <p class="text-gray-600 dark:text-gray-400 mb-6">
                        Hello {{ Auth::user()->username }}, here you can manage everything.
                    </p>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                        <a href="{{ route('admin.news.index') }}"
                            class="block p-6 bg-indigo-50 dark:bg-indigo-900 rounded-lg hover:bg-indigo-100 dark:hover:bg-indigo-800 transition">
                            <h4 class="font-bold text-lg mb-2">📰 Manage News</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Create, edit or delete news items</p>
                        </a>

                        <a href="{{ route('admin.faq-categories.index') }}"
                            class="block p-6 bg-purple-50 dark:bg-purple-900 rounded-lg hover:bg-purple-100 dark:hover:bg-purple-800 transition">
                            <h4 class="font-bold text-lg mb-2">❓ Manage FAQ</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Manage FAQ categories and items</p>
                        </a>

                        <a href="{{ route('admin.forum.index') }}"
                            class="block p-6 bg-pink-50 dark:bg-pink-900 rounded-lg hover:bg-pink-100 dark:hover:bg-pink-800 transition">
                            <h4 class="font-bold text-lg mb-2">💬 Manage Forum</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Manage forum topics and delete
                                inappropriate content</p>
                        </a>

                        <a href="{{ url('/') }}"
                            class="block p-6 bg-green-50 dark:bg-green-900 rounded-lg hover:bg-green-100 dark:hover:bg-green-800 transition">
                            <h4 class="font-bold text-lg mb-2">🌐 Go to website</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-300">View public site</p>
                        </a>

                        <a href="{{ route('news.index') }}"
                            class="block p-6 bg-yellow-50 dark:bg-yellow-900 rounded-lg hover:bg-yellow-100 dark:hover:bg-yellow-800 transition">
                            <h4 class="font-bold text-lg mb-2">👀 Preview News</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-300">View news items like users do</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>