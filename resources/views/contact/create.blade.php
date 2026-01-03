<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Contact Us') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-8 text-gray-900 dark:text-gray-100">
                    <h3 class="text-2xl font-bold mb-6 text-emerald-600 dark:text-emerald-400">Get in Touch 📩</h3>
                    <p class="mb-8 text-gray-600 dark:text-gray-400">
                        Do you have a question, suggestion, or just want to say hello? Fill out the form below and we
                        will get back to you as soon as possible.
                    </p>

                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <!-- Name -->
                            <div>
                                <x-input-label for="name" :value="__('Name')" />
                                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                                    :value="old('name')" required autofocus />
                                <x-input-error :messages="$errors->get('name')" class="mt-2" />
                            </div>

                            <!-- Email -->
                            <div>
                                <x-input-label for="email" :value="__('Email')" />
                                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email"
                                    :value="old('email')" required />
                                <x-input-error :messages="$errors->get('email')" class="mt-2" />
                            </div>
                        </div>

                        <!-- Subject -->
                        <div class="mb-6">
                            <x-input-label for="subject" :value="__('Subject')" />
                            <x-text-input id="subject" class="block mt-1 w-full" type="text" name="subject"
                                :value="old('subject')" required />
                            <x-input-error :messages="$errors->get('subject')" class="mt-2" />
                        </div>

                        <!-- Message -->
                        <div class="mb-6">
                            <x-input-label for="message" :value="__('Message')" />
                            <textarea id="message" name="message" rows="6"
                                class="w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-emerald-500 dark:focus:border-emerald-600 focus:ring-emerald-500 dark:focus:ring-emerald-600 rounded-md shadow-sm"
                                required>{{ old('message') }}</textarea>
                            <x-input-error :messages="$errors->get('message')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <x-primary-button
                                class="bg-emerald-600 hover:bg-emerald-700 focus:bg-emerald-700 active:bg-emerald-800">
                                {{ __('Send Message') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Contact Info Cards -->
                <div
                    class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700 text-center">
                    <div class="text-3xl mb-3">📍</div>
                    <h4 class="font-bold mb-1">Address</h4>
                    <p class="text-sm text-gray-500">Nijverheidskaai 170,<br>1070 Anderlecht</p>
                </div>

                <div
                    class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700 text-center">
                    <div class="text-3xl mb-3">📞</div>
                    <h4 class="font-bold mb-1">Phone</h4>
                    <p class="text-sm text-gray-500">+32 2 xx xx xx </p>
                </div>

                <div
                    class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-100 dark:border-gray-700 text-center">
                    <div class="text-3xl mb-3">📧</div>
                    <h4 class="font-bold mb-1">Email</h4>
                    <p class="text-sm text-gray-500 italic">admin@ehb.be</p>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>