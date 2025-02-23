<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header Section -->
            <div class="mb-8">
                <h1 class="text-3xl font-serif text-gray-800 dark:text-gray-200">
                    {{ __('blog-posts.edit.title') }}
                </h1>
                <p class="mt-2 text-gray-600 dark:text-gray-400">
                    {{ __('blog-posts.edit.subtitle') }}
                </p>
            </div>

            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="max-w-3xl mx-auto">
                        @if ($errors->any())
                            <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative dark:bg-red-900/50 dark:border-red-700 dark:text-red-400"
                                role="alert">
                                <strong class="font-bold">{{ __('blog-posts.edit.error_title') }}</strong>
                                <ul class="mt-2 list-disc list-inside text-sm">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Current Post Info -->
                        <div class="mb-8 p-4 bg-gray-50 dark:bg-gray-900/50 rounded-lg">
                            <div class="flex items-center">
                                <img src="{{ $blogPost->author->profile_photo }}"
                                    alt="{{ $blogPost->author->name }}" class="w-10 h-10 rounded-full">
                                <div class="mr-4">
                                    <div class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ __('blog-posts.show.by') }} {{ $blogPost->author->name }}
                                    </div>
                                    <div class="text-sm text-gray-500 dark:text-gray-400">
                                        {{ $blogPost->created_at->format('Y/m/d H:i') }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <form method="POST" action="{{ route('blog-posts.update', $blogPost) }}" class="space-y-8">
                            @csrf
                            @method('PUT')

                            <!-- Title with Character Counter -->
                            <div>
                                <div class="flex justify-between items-center">
                                    <x-input-label for="title" :value="__('blog-posts.create.title_label')" />
                                    <span class="text-sm text-gray-500 dark:text-gray-400" x-data="{ count: 0 }"
                                        x-init="count = $refs.titleInput.value.length">
                                        <span x-text="count"></span>/100
                                    </span>
                                </div>
                                <x-text-input id="title" class="block mt-2 w-full" type="text" name="title"
                                    x-ref="titleInput" @input="count = $refs.titleInput.value.length" maxlength="100"
                                    :value="old('title', $blogPost->title)" :placeholder="__('blog-posts.create.title_placeholder')" required />
                                <x-input-error :messages="$errors->get('title')" class="mt-2" />
                            </div>

                            <!-- Content with Character Counter and Auto-expand -->
                            <div>
                                <div class="flex justify-between items-center">
                                    <x-input-label for="content" :value="__('blog-posts.create.content_label')" />
                                    <span class="text-sm text-gray-500 dark:text-gray-400" x-data="{ count: 0 }"
                                        x-init="count = $refs.contentInput.value.length">
                                        <span x-text="count"></span> {{ __('blog-posts.create.characters') }}
                                    </span>
                                </div>
                                <div class="relative mt-2" x-data="{
                                    content: '{{ old('content', $blogPost->content) }}',
                                    resize() {
                                        $refs.contentInput.style.height = '150px';
                                        $refs.contentInput.style.height = $refs.contentInput.scrollHeight + 'px';
                                    }
                                }" x-init="resize()">
                                    <textarea id="content" name="content" x-ref="contentInput" x-model="content"
                                        @input="resize(); count = $refs.contentInput.value.length" rows="6"
                                        class="block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm
                                               focus:border-sage-500 focus:ring-sage-500 dark:bg-gray-700 dark:text-gray-300
                                               transition-all duration-200 ease-in-out"
                                        placeholder="{{ __('blog-posts.create.content_placeholder') }}" required></textarea>
                                    <div
                                        class="absolute bottom-3 right-3 text-gray-400 dark:text-gray-600 pointer-events-none">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                        </svg>
                                    </div>
                                </div>
                                <x-input-error :messages="$errors->get('content')" class="mt-2" />
                                <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                    {{ __('blog-posts.create.markdown_support') }}
                                </p>
                            </div>

                            <!-- Action Buttons -->
                            <div class="flex items-center justify-between gap-4">
                                <x-danger-button type="button"
                                    onclick="if(confirm('{{ __('blog-posts.edit.delete_confirm') }}')) { document.getElementById('delete-form').submit(); }">
                                    {{ __('blog-posts.edit.delete') }}
                                </x-danger-button>

                                <div class="flex items-center gap-4">
                                    <x-secondary-button type="button" onclick="window.history.back()">
                                        {{ __('blog-posts.create.cancel') }}
                                    </x-secondary-button>
                                    <x-primary-button>
                                        {{ __('blog-posts.edit.submit') }}
                                    </x-primary-button>
                                </div>
                            </div>
                        </form>

                        <form id="delete-form" action="{{ route('blog-posts.destroy', $blogPost) }}" method="POST"
                            class="hidden">
                            @csrf
                            @method('DELETE')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // اضافه کردن تأیید قبل از ترک صفحه در صورت وجود تغییرات
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

            // حذف تأیید هنگام submit فرم
            form.addEventListener('submit', () => {
                formChanged = false;
            });
        </script>
    @endpush
</x-app-layout>
