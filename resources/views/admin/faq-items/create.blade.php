<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Create FAQ Item') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form method="POST" action="{{ route('admin.faq-items.store') }}">
                        @csrf

                        <!-- Category -->
                        <div>
                            <x-input-label for="faq_category_id" :value="__('Category')" />
                            <select id="faq_category_id" name="faq_category_id"
                                class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('faq_category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('faq_category_id')" class="mt-2" />
                        </div>

                        <!-- Question -->
                        <div class="mt-4">
                            <x-input-label for="question" :value="__('Question')" />
                            <x-text-input id="question" class="block mt-1 w-full" type="text" name="question"
                                :value="old('question')" required />
                            <x-input-error :messages="$errors->get('question')" class="mt-2" />
                        </div>

                        <!-- Answer -->
                        <div class="mt-4">
                            <x-input-label for="answer" :value="__('Answer')" />
                            <textarea id="answer" name="answer" rows="5"
                                class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm"
                                required>{{ old('answer') }}</textarea>
                            <x-input-error :messages="$errors->get('answer')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button class="ml-4">
                                {{ __('Create FAQ Item') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>