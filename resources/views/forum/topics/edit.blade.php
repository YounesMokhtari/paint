<x-app-layout>
    <div class="min-h-screen bg-gray-50">
        <div class="py-12">
            <div class="container mx-auto px-4">
                <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                    <div class="p-8">
                        <!-- Header -->
                        <h2 class="text-2xl font-bold text-gray-900 mb-8">
                            {{ __('forum.topics.edit') }}
                        </h2>

                        @if ($errors->any())
                            <div class="mb-8 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded relative">
                                <strong class="font-bold">{{ __('forum.forms.error_title') }}</strong>
                                <ul class="mt-2 list-disc list-inside text-sm">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('forum-topics.update', $forumTopic) }}" method="POST" class="space-y-6">
                            @csrf
                            @method('PUT')

                            <!-- Title Field -->
                            <div>
                                <div class="flex justify-between items-center mb-2">
                                    <x-input-label for="title" :value="__('forum.forms.title_label')" class="text-base" />
                                    <span class="text-sm text-gray-500 dark:text-gray-400" x-data="{ count: 0 }"
                                        x-init="count = $refs.titleInput.value.length">
                                        <span x-text="count"></span>/100
                                    </span>
                                </div>
                                <x-text-input id="title"
                                    class="block w-full transition-all duration-200 focus:ring-sage-500 focus:border-sage-500"
                                    type="text" name="title" x-ref="titleInput"
                                    @input="count = $refs.titleInput.value.length" maxlength="100" :value="old('title', $forumTopic->title)"
                                    :placeholder="__('forum.forms.title_placeholder')" required />
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>

                            <!-- Content Field -->
                            <div>
                                <div class="flex justify-between items-center mb-2">
                                    <x-input-label for="content" :value="__('forum.forms.content_label')" class="text-base" />
                                    <span class="text-sm text-gray-500 dark:text-gray-400" x-data="{ count: 0 }"
                                        x-init="count = $refs.contentInput.value.length">
                                        <span x-text="count"></span> {{ __('blog-posts.create.characters') }}
                                    </span>
                                </div>
                                <div class="relative" x-data="{
                                    content: '',
                                    resize() {
                                        $refs.contentInput.style.height = '150px';
                                        $refs.contentInput.style.height = $refs.contentInput.scrollHeight + 'px';
                                    }
                                }" x-init="resize()">
                                    <textarea id="content" name="content" x-ref="contentInput" x-model="content"
                                        @input="resize(); count = $refs.contentInput.value.length" rows="6"
                                        class="block w-full rounded-lg border-gray-300 dark:border-gray-600
                                               focus:ring-sage-500 focus:border-sage-500
                                               dark:bg-gray-700 dark:text-gray-300
                                               transition-all duration-200"
                                        placeholder="{{ __('forum.forms.content_placeholder') }}" required>{{ old('content', $forumTopic->content) }}</textarea>
                                    <div
                                        class="absolute bottom-3 right-3 text-gray-400 dark:text-gray-600 pointer-events-none">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <!-- Category -->
                            <div>
                                <x-input-label for="category" :value="__('forum.forms.category_label')" class="text-base" />
                                <select id="category" name="category"
                                    class="mt-1 block w-full rounded-lg border-gray-300 dark:border-gray-600
                                           focus:ring-sage-500 focus:border-sage-500
                                           dark:bg-gray-700 dark:text-gray-300
                                           transition-all duration-200">
                                    <option value="">{{ __('forum.forms.select_category') }}</option>
                                    @foreach (['general', 'help', 'discussion', 'feedback'] as $category)
                                        <option value="{{ $category }}" @selected(old('category', $forumTopic->category) == $category)>
                                            {{ __("forum.categories.$category") }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error :messages="$errors->get('category')" class="mt-2" />
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex justify-end gap-4 pt-6 border-t border-gray-200 dark:border-gray-700">
                                <x-secondary-button type="button" onclick="window.history.back()">
                                    {{ __('forum.actions.cancel') }}
                                </x-secondary-button>
                                <x-primary-button class="bg-sage-600 hover:bg-sage-700">
                                    {{ __('forum.actions.save') }}
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
