<x-app-layout>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="mb-8">
                <h1 class="text-3xl font-serif font-bold text-gray-900 dark:text-gray-100">
                    {{ __('blog-posts.create.title') }}
                </h1>
                <p class="mt-2 text-gray-600 dark:text-gray-400">
                    {{ __('blog-posts.create.subtitle') }}
                </p>
            </div>

            <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg overflow-hidden">
                <div class="p-6">
                    <div class="max-w-3xl mx-auto">
                        @if ($errors->any())
                            <div
                                class="mb-8 bg-red-50 dark:bg-red-900/50 border border-red-200 dark:border-red-800 rounded-lg p-4">
                                <div class="flex items-center mb-2">
                                    <svg class="w-5 h-5 text-red-500 dark:text-red-400 mr-2" fill="none"
                                        stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <h3 class="text-sm font-medium text-red-800 dark:text-red-200">
                                        {{ __('blog-posts.create.error_title') }}
                                    </h3>
                                </div>
                                <ul class="list-disc list-inside text-sm text-red-700 dark:text-red-300">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ route('blog-posts.store') }}" class="space-y-8">
                            @csrf

                            <!-- Title Field -->
                            <div>
                                <div class="flex justify-between items-center mb-2">
                                    <x-input-label for="title" :value="__('blog-posts.create.title_label')" class="text-base" />
                                    <span class="text-sm text-gray-500 dark:text-gray-400" x-data="{ count: 0 }"
                                        x-init="count = $refs.titleInput.value.length">
                                        <span x-text="count"></span>/100
                                    </span>
                                </div>
                                <x-text-input id="title"
                                    class="block w-full transition-all duration-200 focus:ring-sage-500 focus:border-sage-500"
                                    type="text" name="title" x-ref="titleInput"
                                    @input="count = $refs.titleInput.value.length" maxlength="100" :value="old('title')"
                                    :placeholder="__('blog-posts.create.title_placeholder')" required autofocus />
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>

                            <!-- Content Field -->
                            <div>
                                <div class="flex justify-between items-center mb-2">
                                    <x-input-label for="content" :value="__('blog-posts.create.content_label')" class="text-base" />
                                    <span class="text-sm text-gray-500 dark:text-gray-400" x-data="{ count: 0 }"
                                        x-init="count = $refs.contentInput.value.length">
                                        <span x-text="count"></span> {{ __('blog-posts.create.characters') }}
                                    </span>
                                </div>
                                <div class="relative" x-data="{ content: '', resize() { $refs.contentInput.style.height = '150px';
                                        $refs.contentInput.style.height = $refs.contentInput.scrollHeight + 'px'; } }" x-init="resize()">
                                    <textarea id="content" name="content" x-ref="contentInput" x-model="content"
                                        @input="resize(); count = $refs.contentInput.value.length" rows="6"
                                        class="block w-full rounded-lg border-gray-300 dark:border-gray-600
                                               focus:ring-sage-500 focus:border-sage-500
                                               dark:bg-gray-700 dark:text-gray-300
                                               transition-all duration-200"
                                        placeholder="{{ __('blog-posts.create.content_placeholder') }}" required>{{ old('content') }}</textarea>
                                    <div
                                        class="absolute bottom-3 right-3 text-gray-400 dark:text-gray-600 pointer-events-none">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </div>
                                </div>
                                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                    {{ __('blog-posts.create.markdown_support') }}
                                </p>
                            </div>

                            <!-- Category & Tags -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <x-input-label for="category" :value="__('blog-posts.create.category')" class="text-base" />
                                    <select id="category" name="category"
                                        class="block w-full rounded-lg border-gray-300 dark:border-gray-600
                                               focus:ring-sage-500 focus:border-sage-500
                                               dark:bg-gray-700 dark:text-gray-300
                                               transition-all duration-200">
                                        <option value="">{{ __('blog-posts.create.select_category') }}</option>
                                        @foreach (['technology', 'art', 'lifestyle', 'education'] as $category)
                                            <option value="{{ $category }}"
                                                {{ old('category') == $category ? 'selected' : '' }}>
                                                {{ __("blog-posts.categories.$category") }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="space-y-2">
                                    <x-input-label for="tags" :value="__('blog-posts.create.tags')" class="text-base" />
                                    <x-text-input id="tags"
                                        class="block w-full transition-all duration-200 focus:ring-sage-500 focus:border-sage-500"
                                        type="text" name="tags" :value="old('tags')" :placeholder="__('blog-posts.create.tags_placeholder')" />
                                    <p class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ __('blog-posts.create.tags_help') }}
                                    </p>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div
                                class="flex items-center justify-end gap-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                                <x-secondary-button type="button" onclick="window.history.back()"
                                    class="px-4 py-2 text-sm font-medium">
                                    {{ __('blog-posts.create.cancel') }}
                                </x-secondary-button>
                                <x-primary-button class="px-4 py-2 text-sm font-medium bg-sage-600 hover:bg-sage-700">
                                    {{ __('blog-posts.create.submit') }}
                                </x-primary-button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Form change detection
            const form = document.querySelector('form');
            let formChanged = false;

            form.addEventListener('input', () => {
                formChanged = true;
            });

            window.addEventListener('beforeunload', (e) => {
                if (formChanged) {
                    e.preventDefault();
                    e.returnValue = '';
                }
            });

            form.addEventListener('submit', () => {
                formChanged = false;
            });
        </script>
    @endpush
</x-app-layout>
