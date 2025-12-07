<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                {{ __('Edit News Item') }}
            </h2>
            <a href="{{ route('admin.news.index') }}"
               class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 transition">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
               Back
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <form action="{{ route('admin.news.update', $news) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PATCH')

                        <!-- Title -->
                        <div class="mb-6">
                            <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Titel <span class="text-red-500">*</span>
                            </label>
                            <input type="text"
                                   id="title"
                                   name="title"
                                   value="{{ old('title', $news->title) }}"
                                   class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white @error('title') border-red-500 @enderror"
                                   placeholder="New Marvel Movie Annonced!"
                                   required>
                            @error('title')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Content -->
                        <div class="mb-6">
                            <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Inhoud <span class="text-red-500">*</span>
                            </label>
                            <textarea id="content"
                                      name="content"
                                      rows="10"
                                      class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white @error('content') border-red-500 @enderror"
                                      placeholder="Write here your content of your news item."
                                      required>{{ old('content', $news->content) }}</textarea>
                            @error('content')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Current Image -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Current image
                            </label>
                            <div class="mb-4">
                                <img src="{{ asset('storage/' . $news->image) }}"
                                     alt="{{ $news->title }}"
                                     class="max-w-sm h-48 object-cover rounded-lg border border-gray-300 dark:border-gray-600">
                            </div>
                        </div>

                        <!-- New Image Upload -->
                        <div class="mb-6">
                            <label for="image" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                New image <span class="text-gray-500 text-xs">(optioneel)</span>
                            </label>
                            <div class="flex items-center gap-4">
                                <label class="flex flex-col items-center justify-center w-full h-32 border-2 border-gray-300 border-dashed rounded-lg cursor-pointer hover:bg-gray-50 dark:hover:bg-gray-700 dark:border-gray-600 @error('image') border-red-500 @enderror">
                                    <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                        <svg class="w-8 h-8 mb-2 text-gray-500 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                                        </svg>
                                        <p class="mb-2 text-sm text-gray-500 dark:text-gray-400">
                                            <span class="font-semibold">Klik om nieuwe afbeelding te uploaden</span>
                                        </p>
                                        <p class="text-xs text-gray-500 dark:text-gray-400">PNG, JPG, GIF (MAX. 2MB)</p>
                                    </div>
                                    <input id="image"
                                           name="image"
                                           type="file"
                                           accept="image/*"
                                           class="hidden"
                                           onchange="previewImage(event)">
                                </label>
                            </div>
                            @error('image')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                Hold empty to keep current image
                            </p>

                            <!-- New Image Preview -->
                            <div id="imagePreview" class="mt-4 hidden">
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">New image preview:</p>
                                <img id="preview" src="" alt="Preview" class="max-w-sm h-48 object-cover rounded-lg border-2 border-indigo-500">
                            </div>
                        </div>

                        <!-- Publication Date -->
                        <div class="mb-6">
                            <label for="publication_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Publication date <span class="text-red-500">*</span>
                            </label>
                            <input type="date"
                                   id="publication_date"
                                   name="publication_date"
                                   value="{{ old('publication_date', $news->publication_date->format('Y-m-d')) }}"
                                   class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:ring-indigo-500 focus:border-indigo-500 dark:bg-gray-700 dark:text-white @error('publication_date') border-red-500 @enderror"
                                   required>
                            @error('publication_date')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Metadata Info -->
                        <div class="mb-6 p-4 bg-gray-50 dark:bg-gray-900 rounded-lg">
                            <h3 class="text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Metadata</h3>
                            <div class="grid grid-cols-2 gap-4 text-sm">
                                <div>
                                    <span class="text-gray-500 dark:text-gray-400">Author:</span>
                                    <span class="ml-2 text-gray-900 dark:text-white font-medium">{{ $news->user->username }}</span>
                                </div>
                                <div>
                                    <span class="text-gray-500 dark:text-gray-400">Created:</span>
                                    <span class="ml-2 text-gray-900 dark:text-white">{{ $news->created_at->format('d/m/Y H:i') }}</span>
                                </div>
                                <div>
                                    <span class="text-gray-500 dark:text-gray-400">Last edit:</span>
                                    <span class="ml-2 text-gray-900 dark:text-white">{{ $news->updated_at->format('d/m/Y H:i') }}</span>
                                </div>
                                <div>
                                    <span class="text-gray-500 dark:text-gray-400">Status:</span>
                                    @if($news->publication_date->isFuture())
                                        <span class="ml-2 px-2 py-0.5 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-200">
                                            Planned
                                        </span>
                                    @else
                                        <span class="ml-2 px-2 py-0.5 text-xs font-semibold rounded-full bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-200">
                                            Published
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="flex items-center justify-between pt-4 border-t border-gray-200 dark:border-gray-700">
                            <!-- Delete Button -->
                            <form action="{{ route('admin.news.destroy', $news) }}"
                                  method="POST"
                                  onsubmit="return confirm('Are you sure you want to destroy?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:bg-red-700 transition">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    Delete
                                </button>
                            </form>

                            <!-- Save/Cancel Buttons -->
                            <div class="flex items-center gap-4">
                                <a href="{{ route('admin.news.index') }}"
                                   class="px-4 py-2 bg-gray-300 dark:bg-gray-600 text-gray-700 dark:text-gray-200 rounded-md hover:bg-gray-400 dark:hover:bg-gray-500 transition">
                                    Cancel
                                </a>
                                <button type="submit"
                                        class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                    Save Changes
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Preview Link -->
            <div class="mt-6">
                <a href="{{ route('news.show', $news) }}"
                   target="_blank"
                   class="inline-flex items-center text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                    </svg>
                    View News Item
                </a>
            </div>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('imagePreview').classList.remove('hidden');
                    document.getElementById('preview').src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        }
    </script>
</x-app-layout>
