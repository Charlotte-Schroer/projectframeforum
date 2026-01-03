<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Frequently Asked Questions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="space-y-6">
                @foreach($categories as $category)
                    @if($category->items->count() > 0)
                        <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                            <div class="p-6 text-gray-900 dark:text-gray-100">
                                <h3 class="text-lg font-bold mb-4 border-b border-gray-200 dark:border-gray-700 pb-2">
                                    {{ $category->name }}
                                </h3>

                                <div class="space-y-4">
                                    @foreach($category->items as $item)
                                        <div x-data="{ open: false }"
                                            class="border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden">
                                            <button @click="open = !open"
                                                class="flex justify-between items-center w-full p-4 text-left bg-gray-50 dark:bg-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 transition focus:outline-none">
                                                <span class="font-medium text-gray-900 dark:text-white">{{ $item->question }}</span>
                                                <svg class="w-5 h-5 transform transition-transform duration-200"
                                                    :class="{'rotate-180': open}" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 9l-7 7-7-7"></path>
                                                </svg>
                                            </button>
                                            <div x-show="open" x-collapse
                                                class="p-4 bg-white dark:bg-gray-800 border-t border-gray-200 dark:border-gray-700">
                                                <p class="text-gray-600 dark:text-gray-300">{{ $item->answer }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach

                @if($categories->isEmpty())
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-center text-gray-500 dark:text-gray-400">
                            No FAQs found.
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>