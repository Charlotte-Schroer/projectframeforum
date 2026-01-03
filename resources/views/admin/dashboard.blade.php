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
                            class="block p-6 bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg hover:border-emerald-500 dark:hover:border-emerald-500 hover:shadow-md transition duration-200 group">
                            <h4
                                class="font-bold text-lg mb-2 text-gray-900 dark:text-gray-100 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">
                                📰 Manage News</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Create, edit or delete news items</p>
                        </a>

                        <a href="{{ route('admin.users.index') }}"
                            class="block p-6 bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg hover:border-emerald-500 dark:hover:border-emerald-500 hover:shadow-md transition duration-200 group">
                            <h4
                                class="font-bold text-lg mb-2 text-gray-900 dark:text-gray-100 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">
                                👥 Manage Users</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Grant or revoke admin rights</p>
                        </a>

                        <a href="{{ route('admin.faq-categories.index') }}"
                            class="block p-6 bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg hover:border-emerald-500 dark:hover:border-emerald-500 hover:shadow-md transition duration-200 group">
                            <h4
                                class="font-bold text-lg mb-2 text-gray-900 dark:text-gray-100 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">
                                ❓ Manage FAQ</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Manage FAQ categories and items</p>
                        </a>

                        <a href="{{ route('admin.forum.index') }}"
                            class="block p-6 bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg hover:border-emerald-500 dark:hover:border-emerald-500 hover:shadow-md transition duration-200 group">
                            <h4
                                class="font-bold text-lg mb-2 text-gray-900 dark:text-gray-100 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors">
                                💬 Manage Forum</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-300">Manage forum topics and delete
                                inappropriate content</p>
                        </a>

                        <a href="{{ url('/') }}"
                            class="block p-6 bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-100 dark:border-emerald-800 rounded-lg hover:bg-emerald-100 dark:hover:bg-emerald-900/40 transition duration-200">
                            <h4 class="font-bold text-lg mb-2 text-emerald-800 dark:text-emerald-300">🌐 Go to website
                            </h4>
                            <p class="text-sm text-emerald-600 dark:text-emerald-400">View public site</p>
                        </a>

                        <a href="{{ route('news.index') }}"
                            class="block p-6 bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-100 dark:border-emerald-800 rounded-lg hover:bg-emerald-100 dark:hover:bg-emerald-900/40 transition duration-200">
                            <h4 class="font-bold text-lg mb-2 text-emerald-800 dark:text-emerald-300">👀 Preview News
                            </h4>
                            <p class="text-sm text-emerald-600 dark:text-emerald-400">View news items like users do</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>